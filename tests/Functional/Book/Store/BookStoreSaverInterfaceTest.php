<?php

namespace App\Tests\Functional\Book\Store;

use App\Domain\Book\DTO\BookDto;
use App\Domain\Book\Store\BookStoreSaverInterface;
use App\Domain\Book\Store\DTO\BookSaveDto;
use App\Store\Test\StoreBookManagerTest;
use App\Tests\Functional\Book\Store\DataProvider\BookStoreSaverInterfaceDataProviderTrait;
use App\Tests\Functional\Book\TestInterface\Store\StoreBookManagerTestInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class BookStoreSaverInterfaceTest extends KernelTestCase
{
    use BookStoreSaverInterfaceDataProviderTrait;
    private Container $container;
    private StoreBookManagerTestInterface $storeBookManager;
    #[\Override] public function setUp(): void
    {
        self::bootKernel();
        $this->container = static::getContainer();
        $this->storeBookManager = $this->container->get(StoreBookManagerTest::class);
    }

    /**
     * @test
     * @dataProvider saveDataProvider
     */
    public function save(BookSaveDto $bookSaveDto): void
    {
        $initialBookDataSize = $this->storeBookManager->getBookDataSize();
        $bookStoreSaver = $this->container->get(BookStoreSaverInterface::class);
        $bookStoreSaver->save($bookSaveDto);
        $this->assertEquals($initialBookDataSize + 1, $this->storeBookManager->getBookDataSize());
        $this->assertEquals(
            $this->storeBookManager->getLastBookDto(),
            new BookDto(
                $bookSaveDto->id,
                $bookSaveDto->name,
                $bookSaveDto->author,
                $bookSaveDto->publisher,
                $bookSaveDto->year,
                $bookSaveDto->genre,
            )
        );
    }
}