<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mattiabasone
 * Date: 11/29/18
 * Time: 4:35 PM.
 */

namespace Tests\Unit\Domain\Article\ValueObject;

use LaravelDay\Article\ValueObject\Body;
use LaravelDay\Article\ValueObject\Exceptions\BodyTooShort;
use Tests\TestCase;

class BodyTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateTitle()
    {
        $expectedBody = 'This is a valid body (really long string)';
        $body = new Body($expectedBody);
        $this->assertEquals($expectedBody, (string) $body);
        $this->assertTrue($body->isEqual(new Body($expectedBody)));
    }

    /**
     * @test
     */
    public function shouldRaiseBodyTooShortException()
    {
        $this->expectException(BodyTooShort::class);
        $tooShortBody = 'Pippo';
        $body = new Body($tooShortBody);
    }
}
