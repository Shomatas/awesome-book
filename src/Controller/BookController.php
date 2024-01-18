<?php

namespace App\Controller;

use App\Domain\Book\BookRegistration;
use App\Domain\Book\DTO\BookRegistrationDto;
use App\Domain\Exception\DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

#[Route('/books')]
class BookController extends AbstractController
{
    public function __construct(
        readonly private BookRegistration $bookRegistration,
    )
    {
    }

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
        path: '',
        name: 'post_book',
        methods: ['POST']
    )]
    public function postBook(
        // TODO: временное решение, в будущем добавить кастомный resolver
        #[MapRequestPayload] BookRegistrationDto $bookRegistrationDto,
    ): Response
    {
        try {
            $this->bookRegistration->register($bookRegistrationDto);
            return new Response('Успешная регистрация');
        } catch (DomainException $exception) {
            // TODO: обработать более подробно
            return new Response('Ошибка на уровне домена', 500);
        } catch (\Throwable $exception) {
            return new Response('Ошибка на уровне реализации', 500);
        }
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