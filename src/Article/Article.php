<?php

declare(strict_types=1);

namespace LaravelDay\Article;

use LaravelDay\Article\ValueObject\Body;
use LaravelDay\Article\ValueObject\Id;
use LaravelDay\Article\ValueObject\Title;

final class Article
{
    /** @var \LaravelDay\Article\ValueObject\Title */
    private $title;
    /**
     * @var \LaravelDay\Article\ValueObject\Body
     */
    private $body;
    /**
     * @var \DateTimeImmutable
     */
    private $creationDate;
    /**
     * @var \LaravelDay\Article\ValueObject\Id
     */
    private $id;

    /**
     * Article constructor.
     *
     * @param Id                 $id           ID dell'entità
     * @param Title              $title
     * @param Body               $body
     * @param \DateTimeImmutable $creationDate
     */
    public function __construct(Id $id, Title $title, Body $body, \DateTimeImmutable $creationDate)
    {
        $this->title = $title;
        $this->body = $body;
        $this->creationDate = $creationDate;
        $this->id = $id;
    }

    /**
     * @return \LaravelDay\Article\ValueObject\Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @return \LaravelDay\Article\ValueObject\Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreationDate(): \DateTimeImmutable
    {
        return $this->creationDate;
    }

    /**
     * @return \LaravelDay\Article\ValueObject\Id
     */
    public function getId(): Id
    {
        return $this->id;
    }
}
