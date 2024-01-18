<?php

namespace App\Domain\Book\Store\DTO;

use App\Domain\Book\Book;
use Symfony\Component\Uid\Uuid;

readonly class BookSaveDto
{
    public function __construct(
        public Uuid $id,
        public string $name,
        public ?string $author,
        public ?string $publisher,
        public ?int $year,
        public ?string $genre,
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