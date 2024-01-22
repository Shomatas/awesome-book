<?php

namespace App\Tests\Functional\Book\Factory;

use App\Domain\Book\Book;
use App\Domain\Book\Exception\BookValidationException;
use App\Domain\Book\Factory\BookFactory;
use App\Domain\Book\Factory\DTO\BookFactoryDto;
use App\Tests\Functional\Book\Factory\DataProvider\BookFactoryDataProviderTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class BookFactoryTest extends KernelTestCase
{
    use BookFactoryDataProviderTrait;
    public Container $container;
    #[\Override] public function setUp(): void
    {
        self::bootKernel();
        $this->container = static::getContainer();
    }
    /**
     * @test
     * @dataProvider createDataProvider
     */
    public function create(BookFactoryDto $bookFactoryDto): void
    {
        $bookFactory = $this->container->get(BookFactory::class);
        $book = $bookFactory->create($bookFactoryDto);
        $this->assertInstanceOf(Book::class, $book);
    }

    /**
     * @test
     * @dataProvider createWithFailedValidationDataProvider
     */
    public function createWithFailedValidation(BookFactoryDto $bookFactoryDto): void
    {
        $this->expectException(BookValidationException::class);
        $bookFactory = $this->container->get(BookFactory::class);
        $bookFactory->create($bookFactoryDto);
    }
}