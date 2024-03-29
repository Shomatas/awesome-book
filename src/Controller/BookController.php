<?php

namespace App\Controller;

use App\Domain\Book\Store\BookEraserInterface;
use App\Domain\Book\Store\BookGetterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        readonly private BookEraserInterface $bookEraser,
        readonly private BookGetterInterface $bookGetter,
        readonly private BookRegistration $bookRegistration,
    ) {}

    #[Route(
        path: '',
        name: 'get_books',
        methods: ['GET'],
    )]
    public function getBooks(): Response
    {
         try {
            return new JsonResponse($this->bookGetter->getAll()->getArray());
         } catch (\Throwable $exception) {
             return new Response('Ошибка на стороне сервера', 500);
         }
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
            return new Response('Успешная регистрация', 201);
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
        try {
            $this->bookEraser->delete($id);
            return new Response("Кника с идентификатором {$id} удалена!");
        } catch (\Throwable $exception) {
            return new Response('Ошибка на стороне сервера', 500);
        }
    }
}
