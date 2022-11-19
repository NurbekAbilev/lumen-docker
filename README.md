# lumen-docker

Как поднять проект
```
git clone https://github.com/NurbekAbilev/lumen-docker.git
cd lumen-docker/
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan migrate --seed
```

Все тестовые данные будут присутствовать после запуска миграции

## Тестирование
Запуск юнит тестов
```
docker-compose exec app vendor/bin/phpunit
```

## Postman

В корне проекта есть Postman коллекция для тестировния API
```
CTRL + O -> file -> postman_collection.json
```

Можно авторизоваться по тестовому пользователю 
```
username: test@mail.com
password: test
```
 
По желанию можно зарегистрировать нового пользвателя

## Авторизация

Использует bearer token. Доступ авторизованным пользователям для списка компаний и для создания компании

При смене пароля происходит отправка имейла с кодом со сроком жизни 10 минут(password_recovery). Для смены пароля нужна указать валидный код
и имейл
