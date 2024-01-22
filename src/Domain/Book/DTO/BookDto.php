<?php

namespace App\Domain\Book\DTO;

use Symfony\Component\Uid\Uuid;

readonly class BookDto
{
    public function __construct(
        public ?Uuid $id = null,
        public ?string $name = null,
        public ?string $author = null,
        public ?string $publisher = null,
        public ?int $year = null,
        public ?string $genre = null,
    ) {}

}