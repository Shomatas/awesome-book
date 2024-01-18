<?php

namespace App\Tests\Unit\Book\Factory;

use App\Domain\Book\Book;
use App\Domain\Book\Exception\BookValidationException;
use App\Domain\Book\Factory\BookFactory;
use App\Domain\Book\Factory\DTO\BookFactoryDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookFactoryUnitTest extends KernelTestCase
{
    private ValidatorInterface $validator;
    private BookFactoryDto $bookFactoryDto;
    public function setUp(): void
    {
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->bookFactoryDto = new BookFactoryDto(
            'Герой нашего времени',
            'Лермонтов М.Ю.',
            'Мнемоника',
            2014,
            'Мемуары',
        );
    }

    /**
     * @test
     */
    public function create(): void
    {
        $violationList = $this->createMock(ConstraintViolationListInterface::class);
        $violationList->method('count')->willReturn(0);
        $this->validator->method('validate')->willReturn($violationList);
        $bookFactory = new BookFactory($this->validator);

        $book = $bookFactory->create($this->bookFactoryDto);

        $this->assertInstanceOf(Book::class, $book);
    }

    /**
     * @test
     */
    public function createWithFailedValidation(): void
    {
        $this->expectException(BookValidationException::class);

        $violationList = $this->createMock(ConstraintViolationListInterface::class);
        $violationList->method('count')->willReturn(1);
        $this->validator->method('validate')->willReturn($violationList);
        $bookFactory = new BookFactory($this->validator);

        $book = $bookFactory->create($this->bookFactoryDto);
    }
}