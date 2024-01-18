<?php

namespace App\Store;

use App\Domain\Book\DTO\BookDtoCollection;
use App\Domain\Book\Store\BookGetterInterface;
use App\Entity\Books;
use App\Store\DataMapper\BooksEntityDataMapper;
use Doctrine\ORM\EntityManagerInterface;

class BookGetter implements BookGetterInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private BooksEntityDataMapper $booksEntityDataMapper,
    ) {}

    public function getAll(): BookDtoCollection
    {
        $entities = $this->entityManager->getRepository(Books::class)->findAll();
        return $this->booksEntityDataMapper->arrayToBookDtoCollection($entities);
    }
}