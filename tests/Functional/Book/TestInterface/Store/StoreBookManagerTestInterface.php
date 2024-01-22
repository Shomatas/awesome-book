<?php

namespace App\Tests\Functional\Book\TestInterface\Store;

use App\Domain\Book\DTO\BookDto;
use Symfony\Component\Uid\Uuid;

interface StoreBookManagerTestInterface
{
    public function getBookDataSize(): int;
    public function getLastBookDto(): BookDto;
    public function getLastId(): Uuid;
}