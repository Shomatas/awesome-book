<?php

namespace App\Domain\Book\Factory;

use App\Domain\Book\Book;
use App\Domain\Book\Exception\BookValidationException;
use App\Domain\Book\Factory\DTO\BookFactoryDto;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class BookFactory
{
    public function __construct(
        private ValidatorInterface $validator,
    )
    {
    }

    public function create(BookFactoryDto $userFactoryDto): Book
    {
        $violationList = $this->validator->validate($userFactoryDto);
        $this->throwExistingMistakes($violationList);
        return new Book(
            Uuid::v1(),
            $userFactoryDto->name,
            $userFactoryDto->author,
            $userFactoryDto->publisher,
            $userFactoryDto->year,
            $userFactoryDto->genre,
        );
    }

    private function throwExistingMistakes(ConstraintViolationListInterface $violationList): void
    {
        if ($violationList->count() > 0) {
            throw new BookValidationException;
        }
    }
}