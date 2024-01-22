<?php

namespace App\Domain\Book\DTO;

readonly class BookRegistrationDto
{
    public function __construct(
        public string $name = '',
        public ?string $author = null,
        public ?string $publisher = null,
        public ?int $year = null,
        public ?string $genre = null,
    ) {}
}