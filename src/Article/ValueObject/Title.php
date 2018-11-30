<?php

declare(strict_types=1);

namespace LaravelDay\Article\ValueObject;

use LaravelDay\Article\ValueObject\Exceptions\TitleTooShort;

/**
 * Class Title.
 */
final class Title
{
    /** @var string */
    private $title;

    /**
     * Title constructor.
     *
     * @param string $title
     *
     * @throws TitleTooShort
     */
    public function __construct(string $title)
    {
        if (\mb_strlen($title) < 10) {
            throw new TitleTooShort();
        }
        $this->title = $title;
    }

    /**
     * @param Title $title
     *
     * @return bool
     */
    public function isEqual(self $title)
    {
        return (string) $title === (string) $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}
