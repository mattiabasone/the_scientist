<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mattiabasone
 * Date: 11/29/18
 * Time: 3:03 PM.
 */

namespace LaravelDay\Article\UseCase;

class ListArticles
{
    public function __invoke(): array
    {
        return [
            [
                'title' => 'Articolo 1',
                'body' => 'Questo è un articolo',
                'creationDate' => '2018-11-29 00:00:00',
            ],
        ];
    }
}
