<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ListArticlesTest extends TestCase
{
    /**
     * List articles test
     * I metodi nella classe test devono iniziare con la parola "test" o non vengono interpretati da phpunit
     * In alternativa si può usare l'annotation @test.
     *
     * @test
     */
    public function shouldListArticles()
    {
        $response = $this->get('api/articles');
        $response->assertStatus(200);
        $response->assertJson([
            [
                'title' => 'Articolo 1',
                'body' => 'Questo è un articolo',
                'creationDate' => '2018-11-29 00:00:00',
            ],
        ]);
    }
}
