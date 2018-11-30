<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mattiabasone
 * Date: 11/29/18
 * Time: 4:35 PM.
 */

namespace Tests\Unit\Domain\Article\ValueObject;

use LaravelDay\Article\ValueObject\Exceptions\InvalidId;
use LaravelDay\Article\ValueObject\Id;
use Tests\TestCase;

class IdTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateId()
    {
        $expectedId = 1;
        $id = new Id($expectedId);
        $this->assertEquals((string) $expectedId, (string) $id);
        $this->assertTrue($id->isEqual(new Id($expectedId)));
    }

    /**
     * @test
     */
    public function shouldRaiseInvalidIdException()
    {
        $this->expectException(InvalidId::class);
        $invalidId = -23;
        $id = new Id($invalidId);
    }
}
