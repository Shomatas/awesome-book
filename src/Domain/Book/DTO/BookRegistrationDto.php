<?php

namespace App\Domain\Book\DTO;

readonly class BookRegistrationDto
{
    public function __construct(
        public string $name,
        public ?string $author,
        public ?string $publisher,
        public ?int $year,
        public ?string $genre,
    ) {}
}