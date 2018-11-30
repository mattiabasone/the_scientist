<?php

declare(strict_types=1);

namespace LaravelDay\Article\ValueObject;

use LaravelDay\Article\ValueObject\Exceptions\BodyTooShort;

/**
 * Class Body.
 */
final class Body
{
    /** @var string */
    private $body;

    /**
     * Body constructor.
     *
     * @param string $body
     *
     * @throws BodyTooShort
     */
    public function __construct(string $body)
    {
        if (\mb_strlen($body) < 20) {
            throw new BodyTooShort();
        }
        $this->body = $body;
    }

    /**
     * @param Body $title
     *
     * @return bool
     */
    public function isEqual(self $title)
    {
        return (string) $title === (string) $this;
    }

    public function __toString()
    {
        return $this->body;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}
