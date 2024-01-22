<?php

namespace App\Store\Test;

use App\Domain\Book\DTO\BookDto;
use App\Store\DataMapper\BooksEntityDataMapper;
use App\Tests\Functional\Book\TestInterface\Store\StoreBookManagerTestInterface;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class StoreBookManagerTest implements StoreBookManagerTestInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private BooksEntityDataMapper $booksEntityDataMapper,
    )
    {
    }

    #[\Override] public function getBookDataSize(): int
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $query = $queryBuilder->select('COUNT(books) size')
            ->from('App\Entity\Books', 'books')
            ->getQuery();
        $response = $query->getResult()[0];
        return $response['size'];
    }

    #[\Override] public function getLastBookDto(): BookDto
    {
        $query = $this->entityManager->createQuery(
            'SELECT books FROM App\Entity\Books books',
        )
            ->setMaxResults(1)
            ->setFirstResult($this->getBookDataSize() - 1);
        $booksEntity = $query->getResult()[0];
        return $this->booksEntityDataMapper->toBookDto($booksEntity);
    }

    #[\Override] public function getLastId(): Uuid
    {
        $query = $this->entityManager->createQuery(
            'SELECT books.id id FROM App\Entity\Books books',
        )
            ->setMaxResults(1)
            ->setFirstResult($this->getBookDataSize() - 1);
        return $query->getResult()[0]['id'];
    }
}