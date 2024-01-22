<?php

namespace App\Domain\Book\Factory\DTO;

use App\Domain\Book\DTO\BookRegistrationDto;
use Symfony\Component\Validator\Constraints as Assert;

readonly class BookFactoryDto
{
    public function __construct(
        #[Assert\NotBlank]
        public ?string $name = null,
        public ?string $author = null,
        public ?string $publisher = null,
        #[Assert\GreaterThan(0)]
        #[Assert\LessThanOrEqual(2024)]
        public ?int $year = null,
        public ?string $genre = null,
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