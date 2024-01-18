<?php

namespace App\Tests\Unit\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRegistration;
use App\Domain\Book\DTO\BookRegistrationDto;
use App\Domain\Book\Factory\BookFactory;
use App\Domain\Book\Store\BookStoreSaverInterface;
use App\Domain\Book\Store\Exception\BookSaveException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookRegistrationUnitTest extends KernelTestCase
{
    private BookRegistrationDto $bookRegistrationDto;
    private BookFactory $bookFactory;
    private BookStoreSaverInterface $bookStoreSaver;
    private Book $book;
    public function setUp(): void
    {
        $this->bookRegistrationDto = new BookRegistrationDto(
            'Идиот',
            'Достоевский Ф.М.',
            'Москва',
            2019,
            'криминал',
        );
        $this->bookFactory = $this->createMock(BookFactory::class);
        $this->book = $this->createMock(Book::class);
        $this->bookStoreSaver = $this->createMock(BookStoreSaverInterface::class);
    }

    /**
     * @test
     */
    public function register(): void
    {
        $this->expectNotToPerformAssertions();

        $this->bookFactory->method('create')->willReturn($this->book);
        $bookRegistration = new BookRegistration($this->bookFactory, $this->bookStoreSaver);

        $bookRegistration->register($this->bookRegistrationDto);
    }

    /**
     * @test
     */
    public function registerWithFailedSaveBook(): void
    {
        $this->expectException(BookSaveException::class);

        $this->bookFactory->method('create')->willReturn($this->book);
        $this->bookStoreSaver->method('save')->willThrowException(new \Exception);
        $bookRegistration = new BookRegistration($this->bookFactory, $this->bookStoreSaver);

        $bookRegistration->register($this->bookRegistrationDto);
    }
}