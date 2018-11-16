<?php

declare(strict_types=1);

namespace App\Integration\Academic\Repository;

use Acme\Academic\Academic;
use Acme\Academic\AcademicCollection;
use Acme\Academic\Repository\AcademicRepository;
use Acme\Academic\Repository\Exception\AcademicNotFound;
use Acme\Academic\Repository\Exception\ImpossibleToRetrieveAcademics;
use Acme\Academic\Repository\Exception\ImpossibleToSaveAcademic;
use Acme\Academic\ValueObject\AcademicID;
use Acme\Common\Query\Pagination;
use App\Integration\Academic\Mapper\AcademicMapper;
use App\Integration\Common\Query\CrudFacade;
use Illuminate\Database\QueryException;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

final class AcademicQueryBuilderRepository implements AcademicRepository
{
    /**
     * @var AcademicMapper
     */
    private $academicMapper;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CrudFacade
     */
    private $query;

    public function __construct(CrudFacade $query,
                                AcademicMapper $academicMapper,
                                LoggerInterface $logger
    ) {
        $this->academicMapper = $academicMapper;
        $this->logger = $logger;
        $this->query = $query;
    }

    public function getById(AcademicID $academicID): Academic
    {
        try {
            $rawAcademic = $this->query->getById($academicID);
        } catch (QueryException $e) {
            $this->logger->error('database failure', ['exception' => $e, 'academic_id' => (string) $academicID]);
            throw new ImpossibleToRetrieveAcademics($e);
        }

        if (null === $rawAcademic) {
            $this->logger->warning('academic not found', ['academic_id' => (string) $academicID]);
            throw new AcademicNotFound($academicID);
        }

        return $this->academicMapper->fromArray($rawAcademic);
    }

    public function list(int $skip = self::DEFAULT_SKIP, int $take = self::DEFAULT_TAKE): AcademicCollection
    {
        try {
            $pagination = $this->getPagination($skip, $take);

            $rawAcademics = $this->query->getAll($pagination);
        } catch (QueryException $e) {
            $this->logger->warning('database failure', ['exception' => $e]);
            throw new ImpossibleToRetrieveAcademics($e);
        }

        return $this->serializeList($rawAcademics);
    }

    public function nextID(): AcademicID
    {
        return AcademicID::fromUUID((string) Uuid::uuid4());
    }

    /**
     * @throws ImpossibleToSaveAcademic
     */
    public function add(Academic $academic): void
    {
        try {
            $rawAcademic = $this->academicMapper->fromAcademic($academic);
            $this->query->save($rawAcademic);
        } catch (QueryException $e) {
            $this->logger->error('database failure', ['exception' => $e, 'academic' => $rawAcademic]);
            throw new ImpossibleToSaveAcademic($e);
        }
    }

    /**
     * @throws ImpossibleToSaveAcademic
     */
    public function update(Academic $academic): void
    {
        try {
            $rawAcademic = $this->academicMapper->fromAcademic($academic);
            $this->query->update($academic->id(), $rawAcademic);
        } catch (QueryException $e) {
            $this->logger->error('database failure', ['exception' => $e, 'academic' => $rawAcademic]);
            throw new ImpossibleToSaveAcademic($e);
        }
    }

    /**
     * @param int $skip
     * @param int $take
     *
     * @return Pagination
     */
    private function getPagination(int $skip, int $take): Pagination
    {
        if ($take > AcademicRepository::MAX_SIZE) {
            $take = AcademicRepository::MAX_SIZE;
        }

        return new Pagination($skip, $take);
    }

    private function serialize(array $academic): Academic
    {
        return $this->academicMapper->fromArray($academic);
    }

    /**
     * @param $rawAcademics
     *
     * @return array
     */
    private function serializeList(array $rawAcademics): AcademicCollection
    {
        $list = \array_map(
            function (array &$rawAcademic) {
                return $this->serialize((array) $rawAcademic);
            },
            $rawAcademics
        );

        return new AcademicCollection(...$list);
    }
}
