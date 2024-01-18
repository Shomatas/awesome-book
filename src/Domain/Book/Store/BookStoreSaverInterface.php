<?php

namespace App\Domain\Book\Store;

use App\Domain\Book\Store\DTO\BookSaveDto;

interface BookStoreSaverInterface
{
    public function save(BookSaveDto $bookSaveDto): void;
}