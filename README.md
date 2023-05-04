# Пример реализации REST API на Laravel 8.8x

Репозиторий содержит пример реализации REST API с Bearer Token авторизацией на Laravel 8.8.
Реализовано два основных метода

    GET /api/currencies — возвращает список курсов валют с возможность пагинации
    GET /api/currency/{id} — возвращает курс валюты для переданного id

Методы для авторизации

    POST /api/auth/login
    POST /api/auth/logout
    POST /api/auth/me

Авторизация реализована с использованием библиотеки jwt-auth. Установка версии для Laravel 8.x

    composer require tymon/jwt-auth:1.0.2


Приложение содержит консольную команду для обновления курсов валют в БД:

    php artisan currency:get

    
