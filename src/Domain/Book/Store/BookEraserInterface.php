<?php

namespace App\Domain\Book\Store;

use Symfony\Component\Uid\Uuid;

interface BookEraserInterface
{
    public function delete(Uuid $id): void;
}