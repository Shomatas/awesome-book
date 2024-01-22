<?php

namespace App\Tests\Functional\Book\Factory\DataProvider;

use App\Domain\Book\Factory\DTO\BookFactoryDto;

trait BookFactoryDataProviderTrait
{
    public static function createDataProvider(): array
    {
        return [
            'When BookFactoryDto has minimum allowed data' => [
                'bookFactoryDto' => new BookFactoryDto('Преступление и наказание'),
            ],
            'When BookFactory has maximum allowed data' => [
                'bookFactoryDto' => new BookFactoryDto(
                    'Преступление и наказание',
                    'Достоевский Ф.М.',
                    'Чайковвский',
                    2015,
                    'Психологический реализм',
                ),
            ],
        ];
    }

    public static function createWithFailedValidationDataProvider(): array
    {
        return [
            'When name is blank' => [
                'bookFactoryDto' => new BookFactoryDto('')
            ],
            'When year is negative' => [
                'bookFactoryDto' => new BookFactoryDto(
                    name: 'Преступление и наказание',
                    year: -10,
                ),
            ],
            'When year equal zero' => [
                'bookFactoryDto' => new BookFactoryDto(
                    name: 'Преступление и наказание',
                    year: 0,
                ),
            ],
            'When year is greater than maximum allowed year' => [
                'bookFactoryDto' => new BookFactoryDto(
                    name: 'Преступление и наказание',
                    year: 2025,
                )
            ]
        ];
    }
}