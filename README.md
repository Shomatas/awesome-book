# API каталога книг
## Установка и использование
Для запуска проекта необходимо склонировать данный репозиторий
```
git clone https://github.com/Shomatas/awesome-book.git
```
Далее в папке с проектом нужно переключиться на ветку development
```
git checkout development
```
После, необходимо запустить docker-контейнеры
```
docker-compose up -d
```
Для загрузки сторонних библиотек используется пакетный менеджер composer. Утилита symfony хранит внутри себя реализацию composer. Установите пакеты внутри контейнера
```
docker-compose exec -it awesome-book symfony composer install
```
Выполните миграцию
```
docker-compose exec -it awesome-book symfony console doctrine:migrations:migrate
```
Проект готов к запуску. Для запуска необходимо запустить внутри контейнера awesome-book symfony-сервер
```
docker-compose exec -it awesome-book symfony server:start -d
```
Проект запущен. Первым делом нужно авторизоваться на сервисе. Рекомендуется пользоваться программой Postman для отправки запросов на сервер.
Данный сервер имеет только один логин и пароль, с помощью которого можно авторизоваться:
```JSON
{
    "username": "admin",
    "password": "1234"
}
```
После отправки json на http://localhost/login, должен вернуться json ответ с токеном.
После получения токена можно пользоваться методами API:
```
GET /books
POST /books
DELETE /books/{id}
```
### POST /books
Для регистрации книги в системе необходимо отправить POST запрос с обязательными полями: name, и необязательными: author, publisher, year (int), genre.
Например:
```JSON
{
    "name": "Мы",
    "year": 1951,
}
```
Создаст книгу с именем "Мы" и 1951 годом.
### GET /books
Данный запрос выдаст json ответ со списком книги вместе с их идентификаторами.
### DELETE /books/{id}
Удаляет из системы книгу с идентификатором {id}