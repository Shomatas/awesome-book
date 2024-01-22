<?php

namespace App\Tests\Functional\Book\Store\DataProvider;

use App\Domain\Book\Store\DTO\BookSaveDto;
use Symfony\Component\Uid\Uuid;

trait BookStoreSaverInterfaceDataProviderTrait
{
    public function saveDataProvider(): array
    {
        return [
            'When BookSaveDto has minimum allowed data' => [
                'bookSaveDto' => new BookSaveDto(Uuid::v1(), 'Преступление и наказание'),
            ],
            'When BookSaveDto has maximum allowed data' => [
                'bookSaveDto' => new BookSaveDto(
                    Uuid::v1(),
                    'Преступление и наказание',
                    'Достоевский Ф.М.',
                    'Чайковвский',
                    1866,
                    'Психологический реализм',
                ),
            ],
        ];
    }
}