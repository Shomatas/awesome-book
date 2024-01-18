<?php

namespace App\Store;

use App\Domain\Book\Store\BookStoreSaverInterface;
use App\Domain\Book\Store\DTO\BookSaveDto;
use App\Entity\Books;
use Doctrine\ORM\EntityManagerInterface;

class BookStoreSaver implements BookStoreSaverInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {

    }

    #[\Override] public function save(BookSaveDto $bookSaveDto): void
    {
        $booksEntity = Books::createFromBookSaveDto($bookSaveDto);
        $this->entityManager->persist($booksEntity);
        $this->entityManager->flush();
    }
}