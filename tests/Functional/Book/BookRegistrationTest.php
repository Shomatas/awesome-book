<?php

namespace App\Tests\Functional\Book;

use App\Domain\Book\BookRegistration;
use App\Domain\Book\DTO\BookDto;
use App\Domain\Book\DTO\BookRegistrationDto;
use App\Domain\Book\Exception\BookValidationException;
use App\Domain\Book\Store\BookStoreSaverInterface;
use App\Domain\Book\Store\DTO\BookSaveDto;
use App\Store\Test\StoreBookManagerTest;
use App\Tests\Functional\Book\DataProvider\BookRegistrationDataProviderTrait;
use App\Tests\Functional\Book\TestInterface\Store\StoreBookManagerTestInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Uid\Uuid;

class BookRegistrationTest extends KernelTestCase
{
    use BookRegistrationDataProviderTrait;
    private Container $container;
    private StoreBookManagerTestInterface $storeBookManagerTest;
    #[\Override] public function setUp(): void
    {
        self::bootKernel();
        $this->container = static::getContainer();
        $this->storeBookManagerTest = $this->container->get(StoreBookManagerTest::class);
    }

    /**
     * @test
     * @dataProvider createDataProvider
     */
    public function create(BookRegistrationDto $bookRegistrationDto): void
    {
        $initialBookDataSize = $this->storeBookManagerTest->getBookDataSize();
        $bookRegistration = $this->container->get(BookRegistration::class);
        $bookRegistration->register($bookRegistrationDto);
        $this->assertEquals($initialBookDataSize + 1, $this->storeBookManagerTest->getBookDataSize());
        $this->assertEquals(
            $this->storeBookManagerTest->getLastBookDto(),
            new BookDto(
                $this->storeBookManagerTest->getLastId(),
                $bookRegistrationDto->name,
                $bookRegistrationDto->author,
                $bookRegistrationDto->publisher,
                $bookRegistrationDto->year,
                $bookRegistrationDto->genre,
            )
        );
    }

    /**
     * @test
     * @dataProvider createWithFailedValidationDataProvider
     */
    public function createWithFailedValidation(BookRegistrationDto $bookRegistrationDto): void
    {
        $this->expectException(BookValidationException::class);
        $initialBookDataSize = $this->storeBookManagerTest->getBookDataSize();
        $bookRegistration = $this->container->get(BookRegistration::class);
        $bookRegistration->register($bookRegistrationDto);
        $this->assertEquals($initialBookDataSize, $this->storeBookManagerTest->getBookDataSize());
    }
}