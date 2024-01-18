<?php

namespace App\Domain\Book\DTO;

use App\common\Collection\AbstractCollection;

class BookDtoCollection extends AbstractCollection
{

    protected function getClassName(): string
    {
        return BookDto::class;
    }
}