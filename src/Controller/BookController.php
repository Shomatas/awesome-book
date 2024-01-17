<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

#[Route('/books')]
class BookController extends AbstractController
{
    #[Route(
        path: '/',
        name: 'get_books',
        methods: ['GET'],
    )]
    public function getBooks(): Response
    {
        // Заглушка для метода получения книг
        return new Response('Get Books');
    }

    #[Route(
        path: '/{id}',
        name: 'post_book',
        methods: ['POST']
    )]
    public function postBook(
        Uuid $id,
    ): Response
    {
        // Заглушка для метода добавления книги
        return new Response("Post Book {$id}");
    }

    #[Route(
        path: '/{id}',
        name: 'delete_book',
        methods: ['DELETE']
    )]
    public function deleteBook(
        Uuid $id,
    ): Response
    {
        // Заглушка для метода удаления книги
        return new Response("Delete Book {$id}");
    }
}