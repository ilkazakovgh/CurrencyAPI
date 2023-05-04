# Пример реализации REST API на Laravel 8.8x

Репозиторий содержит пример реализации REST API с Bearer Token авторизацией 
на Laravel 8.8. API позволяет получать актуальные курсы валют на основе 
данных, публикуемых на сайте ЦБ РФ. Реализовано два основных метода

    GET /api/currencies — возвращает список курсов валют с возможность пагинации
    GET /api/currency/{id} — возвращает курс валюты для переданного id

Приложение содержит консольную команду для обновления курсов валют в БД с сайта ЦБ РФ
(http://www.cbr.ru/scripts/XML_daily.asp):

    php artisan currency:get

В БД хранятся только актуальные курсы валют. 

Методы для авторизации

    POST /api/auth/login
    POST /api/auth/logout
    POST /api/auth/me

Авторизация реализована с использованием библиотеки jwt-auth. Установка версии для Laravel 8.x

    composer require tymon/jwt-auth:1.0.2



    
