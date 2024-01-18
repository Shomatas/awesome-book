<?php

namespace App\Domain\Book;

use App\Domain\Book\DTO\BookRegistrationDto;
use App\Domain\Book\Factory\BookFactory;
use App\Domain\Book\Factory\DTO\BookFactoryDto;
use App\Domain\Book\Store\BookStoreSaverInterface;
use App\Domain\Book\Store\DTO\BookSaveDto;
use App\Domain\Book\Store\Exception\BookSaveException;

class BookRegistration
{
    public function __construct(
        private BookFactory $bookFactory,
        private BookStoreSaverInterface $bookStoreSaver,
    ) {}
    public function register(BookRegistrationDto $bookRegistrationDto): void
    {
        $bookFactoryDto = BookFactoryDto::createFromBookRegistrationDto($bookRegistrationDto);
        $book = $this->bookFactory->create($bookFactoryDto);
        $bookSaveDto = BookSaveDto::createFromBook($book);
        $this->saveToStore($bookSaveDto);
    }

    private function saveToStore(BookSaveDto $bookSaveDto)
    {
        try {
            $this->bookStoreSaver->save($bookSaveDto);
        } catch (\Throwable $exception) {
            throw new BookSaveException;
        }
    }
}