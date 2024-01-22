<?php

namespace App\DataFixtures;

use App\Entity\Books;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class BookFixtures extends Fixture
{
    const int DATA_SIZE = 100;
    #[\Override] public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::DATA_SIZE; ++$i) {
            $id = Uuid::v1();
            $name = 'name_' . $i;
            $author = ($i & 1) ? 'author_'. $i : null;
            $publisher = ($i & 2) ? 'publisher_'. $i : null;
            $year = ($i & 4) ? $i : null;
            $genre = ($i & 8) ? 'genre_' . $i : null;
            $bookEntity = new Books($id, $name, $author, $publisher, $year, $genre);
            $manager->persist($bookEntity);
        }
        $manager->flush();
    }
}