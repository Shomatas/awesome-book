<?php

namespace App\Domain\Book\Factory;

use App\Domain\Book\Book;
use App\Domain\Book\Exception\BookValidationException;
use App\Domain\Book\Factory\DTO\BookFactoryDto;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookFactory
{
    public function __construct(
        private ValidatorInterface $validator,
    )
    {
    }

    public function create(BookFactoryDto $bookFactoryDto): Book
    {
        $violationList = $this->validator->validate($bookFactoryDto);
        $this->throwExistingMistakes($violationList);
        return new Book(
            Uuid::v1(),
            $bookFactoryDto->name,
            $bookFactoryDto->author,
            $bookFactoryDto->publisher,
            $bookFactoryDto->year,
            $bookFactoryDto->genre,
        );
    }

    private function throwExistingMistakes(ConstraintViolationListInterface $violationList): void
    {
        if ($violationList->count() > 0) {
            throw new BookValidationException;
        }
    }
}