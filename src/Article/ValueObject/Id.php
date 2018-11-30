<?php

declare(strict_types=1);

namespace LaravelDay\Article\ValueObject;

use LaravelDay\Article\ValueObject\Exceptions\InvalidId;

/**
 * Class Body.
 */
final class Id
{
    /** @var int */
    private $id;

    /**
     * Body constructor.
     *
     * @param int $id
     *
     * @throws InvalidId
     */
    public function __construct(int $id)
    {
        if ($id <= 0) {
            throw new InvalidId();
        }
        $this->id = $id;
    }

    /**
     * @param Id $id
     *
     * @return bool
     */
    public function isEqual(self $id)
    {
        return (string) $id === (string) $this;
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    public function getId()
    {
        return $this->id;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}
