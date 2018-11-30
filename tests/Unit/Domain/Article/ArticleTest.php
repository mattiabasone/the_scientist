<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Article;

use LaravelDay\Article\Article;
use LaravelDay\Article\ValueObject\Body;
use LaravelDay\Article\ValueObject\Id;
use LaravelDay\Article\ValueObject\Title;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function shouldCreateAnArticle()
    {
        $id = new Id(1);
        $title = new Title('Questo è il titolo');
        $body = new Body("Questo è il mio body e dev'essere più lungo del title");
        $creationDate = new \DateTimeImmutable();

        $article = new Article($id, $title, $body, $creationDate);
        $this->assertSame($id, $article->getId());
        $this->assertSame($title, $article->getTitle());
        $this->assertSame($body, $article->getBody());
        $this->assertSame($creationDate, $article->getCreationDate());
    }
}
