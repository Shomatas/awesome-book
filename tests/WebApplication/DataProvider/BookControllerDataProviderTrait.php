<?php

namespace App\Tests\WebApplication\DataProvider;

trait BookControllerDataProviderTrait
{
    public static function postBookDataProvider(): array
    {
        return [
            'When request has minimal allowed data' => [
                'requestParams' => json_encode([
                    'name' => 'Преступление и наказание',
                ], JSON_UNESCAPED_UNICODE),
            ],
            'When request has author' => [
                'requestParams' => json_encode([
                    'name' => 'Преступление и наказание',
                    'author' => 'Достоевский М.Ю.',
                ], JSON_UNESCAPED_UNICODE),
            ],
            'When request has publisher' => [
                'requestParams' => json_encode([
                    'name' => 'Преступление и наказание',
                    'author' => 'Достоевский М.Ю.',
                    'publisher' => 'Чайковвский',
                ], JSON_UNESCAPED_UNICODE),
            ],
            'When request has year' => [
                'requestParams' => json_encode([
                    'name' => 'Преступление и наказание',
                    'author' => 'Достоевский М.Ю.',
                    'publisher' => 'Чайковвский',
                    'year' => 1866,
                ], JSON_UNESCAPED_UNICODE),
            ],
            'When request has genre' => [
                'requestParams' => json_encode([
                    'name' => 'Преступление и наказание',
                    'author' => 'Достоевский М.Ю.',
                    'publisher' => 'Чайковвский',
                    'year' => 1866,
                    'genre' => 'Криминал',
                ], JSON_UNESCAPED_UNICODE),
            ],
        ];
    }
}