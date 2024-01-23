<?php

namespace App\Tests\WebApplication;

use App\Store\Test\StoreBookManagerTest;
use App\Tests\Functional\Book\TestInterface\Store\StoreBookManagerTestInterface;
use App\Tests\WebApplication\DataProvider\BookControllerDataProviderTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;

class BookControllerTest extends WebTestCase
{
    use BookControllerDataProviderTrait;
    public KernelBrowser $client;
    public string $token;
    public Container $container;
    public StoreBookManagerTestInterface $storeBookManager;

    #[\Override] public function setUp(): void
    {
        $this->client = static::createClient();
        $this->client->request(
            method: 'POST',
            uri: '/login',
            server: [
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode([
                'username' => 'admin',
                'password' => '1234'
            ], JSON_UNESCAPED_UNICODE)
        );
        $this->token = 'Bearer ' . json_decode($this->client->getResponse()->getContent(), true)['token'];
        $this->container = static::getContainer();
        $this->storeBookManager = $this->container->get(StoreBookManagerTest::class);
    }

    /**
     * @test
     */
    public function getUnauthorizedException(): void
    {
        $this->client->request('GET', '/books');
        $this->assertResponseStatusCodeSame(401);
    }

    /**
     * @test
     */
    public function getBooks(): void
    {
        $this->client->request(
            method: 'GET',
            uri: '/books',
            server: [
                'HTTP_AUTHORIZATION' => $this->token,
            ]
        );
        $this->assertResponseIsSuccessful();
    }

    /**
     * @test
     * @dataProvider postBookDataProvider
     */
    public function postBook(string $requestParams): void
    {
        $initialDataSize = $this->storeBookManager->getBookDataSize();
        $this->client->request(
            method: 'POST',
            uri: '/books',
            server: [
                'HTTP_AUTHORIZATION' => $this->token,
                'CONTENT_TYPE' => 'application/json',
            ],
            content: $requestParams
        );
        $this->assertResponseStatusCodeSame(201);
        $this->assertEquals($initialDataSize + 1, $this->storeBookManager->getBookDataSize());
    }

    /**
     * @test
     */
    public function deleteBook(): void
    {
        $initialDataSize = $this->storeBookManager->getBookDataSize();
        $this->client->request(
            method: 'DELETE',
            uri: '/books/' . $this->storeBookManager->getLastId(),
            server: [
                'HTTP_AUTHORIZATION' => $this->token,
            ]
        );
        $this->assertResponseIsSuccessful();
        $this->assertEquals($initialDataSize - 1, $this->storeBookManager->getBookDataSize());
    }
}