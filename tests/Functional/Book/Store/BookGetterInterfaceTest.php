<?php

namespace App\Tests\Functional\Book\Store;

use App\Domain\Book\Store\BookGetterInterface;
use App\Store\Test\StoreBookManagerTest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class BookGetterInterfaceTest extends KernelTestCase
{
    private Container $container;
    private StoreBookManagerTest $storeBookManager;
    #[\Override] public function setUp(): void
    {
        self::bootKernel();
        $this->container = static::getContainer();
        $this->storeBookManager = $this->container->get(StoreBookManagerTest::class);
    }

    /**
     * @test
     */
    public function getAll(): void
    {
        $bookGetter = $this->container->get(BookGetterInterface::class);
        $initialDataSize = $this->storeBookManager->getBookDataSize();
        $bookDtoCollection = $bookGetter->getAll();
        $this->assertEquals($initialDataSize, $this->storeBookManager->getBookDataSize());
        $this->assertEquals($initialDataSize, $bookDtoCollection->count());
    }
}