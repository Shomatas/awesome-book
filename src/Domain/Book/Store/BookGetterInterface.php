<?php

namespace App\Domain\Book\Store;

use App\Domain\Book\DTO\BookDtoCollection;

interface BookGetterInterface
{
    public function getAll(): BookDtoCollection;
}