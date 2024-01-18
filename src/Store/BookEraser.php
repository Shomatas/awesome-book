<?php

namespace App\Store;

use App\Domain\Book\Store\BookEraserInterface;
use App\Entity\Books;
use App\Store\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class BookEraser implements BookEraserInterface
{
    public function __construct(
        readonly private EntityManagerInterface $entityManager,
    ) {}

    public function delete(Uuid $id): void
    {
        $entity = $this->entityManager->getRepository(Books::class)->findOneBy(["id" => $id]);
        if (is_null($entity)) {
            throw new NotFoundException;
        }
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}