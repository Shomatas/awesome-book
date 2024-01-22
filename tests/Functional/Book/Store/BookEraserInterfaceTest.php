<?php

namespace App\Tests\Functional\Book\Store;

use App\Domain\Book\Store\BookEraserInterface;
use App\Store\Test\StoreBookManagerTest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class BookEraserInterfaceTest extends KernelTestCase
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
    public function delete(): void
    {
        $initialDataSize = $this->storeBookManager->getBookDataSize();
        $bookEraser = $this->container->get(BookEraserInterface::class);
        $bookEraser->delete($this->storeBookManager->getLastId());
        $this->assertEquals($initialDataSize - 1, $this->storeBookManager->getBookDataSize());
    }
}