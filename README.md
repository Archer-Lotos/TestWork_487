# TestWork 487

## Проект на Laravel (REST API), только Backend! Особенности реализации:

1. Проект содержит базу данных из двух таблиц со связью многие ко многим;
2. Работа с базой должна осуществляться через паттерн репозиторий;
3. Необходимо реализовать простую аутентификацию через ключ (не используя доп. пакеты passport, jwt etc.);
4. API должно предоставлять доступ к данным с возможностью сортировки и поиску по нескольким полям;
5. В процессе работы с данными необходимо использовать атрибут pivot для моделей и включить его в запросы по поиску.


## Установка

1. Установить php 8 и настроить веб сервер 
2. Клонировать репозиторий: `git clone git@github.com:Lotos2021/TestWork_487.git`
3. Установить зависимости composer: `composer install`
4. Создать файл .env в корне приложения: `cp .env.example .env`
5. Создать БД и пользователя БД
6. Настроить .env файл
7. Запустить миграции БД: `php artisan migrate:fresh --seed`
