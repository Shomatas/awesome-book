<?php

namespace App\Tests\Functional\Book\DataProvider;

use App\Domain\Book\BookRegistration;
use App\Domain\Book\DTO\BookRegistrationDto;

trait BookRegistrationDataProviderTrait
{
    public static function createDataProvider(): array
    {
        return [
            'When BookRegistrationDto has minimum allowed data' => [
                'bookRegistrationDto' => new BookRegistrationDto(
                    'Преступление и наказание',
                ),
            ],
            'When BookRegistrationDto has maximum allowed data' => [
                'bookRegistrationDto' => new BookRegistrationDto(
                    'Преступление и наказние',
                    'Достоевский Ф.М.',
                    'Чайковвский',
                    1866,
                    'Криминал'
                )
            ]
        ];
    }

    public static function createWithFailedValidationDataProvider(): array
    {
        return [
            'When name is blank' => [
                'bookRegistrationDto' => new BookRegistrationDto(''),
            ],
            'When year is negative' => [
                'bookRegistrationDto' => new BookRegistrationDto(
                    name: 'Преступление и наказание',
                    year: -10,
                ),
            ],
            'When year is zero' => [
                'bookRegistrationDto' => new BookRegistrationDto(
                    name: 'Преступление и наказание',
                    year: 0,
                ),
            ],
            'When year is greater than maximum allowed year' => [
                'bookRegistrationDto' => new BookRegistrationDto(
                    name: 'Преступление и наказание',
                    year: 2025,
                ),
            ],
        ];
    }
}