<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mattiabasone
 * Date: 11/29/18
 * Time: 4:35 PM.
 */

namespace Tests\Unit\Domain\Article\ValueObject;

use LaravelDay\Article\ValueObject\Exceptions\TitleTooShort;
use LaravelDay\Article\ValueObject\Title;
use Tests\TestCase;

class TitleTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateTitle()
    {
        $expectedTitle = 'Valid title';
        $title = new Title($expectedTitle);
        $this->assertEquals($expectedTitle, (string) $title);
        $this->assertTrue($title->isEqual(new Title($expectedTitle)));
    }

    /**
     * @test
     */
    public function shouldRaiseTitleTooShortException()
    {
        $this->expectException(TitleTooShort::class);
        $invalidTitle = 'Short';
        $title = new Title($invalidTitle);
    }
}
