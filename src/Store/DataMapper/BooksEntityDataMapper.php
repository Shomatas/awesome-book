<?php

namespace App\Store\DataMapper;

use App\Domain\Book\DTO\BookDto;
use App\Domain\Book\DTO\BookDtoCollection;
use App\Entity\Books;

class BooksEntityDataMapper
{
    public function toBookDto(Books $booksEntity): BookDto
    {
        return new BookDto(
            $booksEntity->getId(),
            $booksEntity->getName(),
            $booksEntity->getAuthor(),
            $booksEntity->getPublisher(),
            $booksEntity->getYear(),
            $booksEntity->getGenre(),
        );
    }

    /**
     * @param Books[] $booksEntityCollection
     */
    public function arrayToBookDtoCollection(array $booksEntityCollection): BookDtoCollection
    {
        $bookDtoCollection = new BookDtoCollection;
        foreach ($booksEntityCollection as $booksEntity) {
            $bookDtoCollection[] = $this->toBookDto($booksEntity);
        }
        return $bookDtoCollection;
    }
}