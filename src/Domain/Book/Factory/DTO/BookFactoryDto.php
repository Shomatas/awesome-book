<?php

namespace App\Domain\Book\Factory\DTO;

use App\Domain\Book\DTO\BookRegistrationDto;

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

    public static function createFromBookRegistrationDto(
        BookRegistrationDto $bookRegistrationDto,
    ): self
    {
        return new BookFactoryDto(
            $bookRegistrationDto->name,
            $bookRegistrationDto->author,
            $bookRegistrationDto->publisher,
            $bookRegistrationDto->year,
            $bookRegistrationDto->genre,
        );
    }
}