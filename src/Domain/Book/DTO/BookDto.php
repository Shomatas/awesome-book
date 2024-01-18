<?php

namespace App\Domain\Book\DTO;

use Symfony\Component\Uid\Uuid;

readonly class BookDto
{
    public function __construct(
        public Uuid $id,
        public string $name,
        public ?string $author,
        public ?string $publisher,
        public ?int $year,
        public ?string $genre,
    ) {}
}