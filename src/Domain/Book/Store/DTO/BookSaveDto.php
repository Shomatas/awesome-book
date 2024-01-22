<?php

namespace App\Domain\Book\Store\DTO;

use App\Domain\Book\Book;
use Symfony\Component\Uid\Uuid;

readonly class BookSaveDto
{
    public function __construct(
        public ?Uuid $id = null,
        public ?string $name = null,
        public ?string $author = null,
        public ?string $publisher = null,
        public ?int $year = null,
        public ?string $genre = null,
    ) {}

    public static function createFromBook(Book $book): self
    {
        return new BookSaveDto(
            $book->getId(),
            $book->getName(),
            $book->getAuthor(),
            $book->getPublisher(),
            $book->getYear(),
            $book->getGenre(),
        );
    }
}