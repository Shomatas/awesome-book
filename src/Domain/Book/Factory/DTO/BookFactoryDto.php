<?php

namespace App\Domain\Book\Factory\DTO;

readonly class BookFactoryDto
{
    public function __construct(
        public string $name,
        public ?string $author,
        public ?string $publisher,
        public ?int $year,
        public ?string $genre,
    )
    {
    }
}