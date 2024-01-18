<?php

namespace App\Domain\Book\Factory\DTO;

use Symfony\Component\Validator\Constraints as Assert;

readonly class BookFactoryDto
{
    public function __construct(
        #[Assert\NotBlank]
        public string $name,
        public ?string $author,
        public ?string $publisher,
        #[Assert\GreaterThan(0)]
        #[Assert\LessThanOrEqual(2024)]
        public ?int $year,
        public ?string $genre,
    )
    {
    }
}