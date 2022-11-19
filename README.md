# lumen-docker

Как поднять проект
```
git clone https://github.com/NurbekAbilev/lumen-docker.git
cd lumen-docker/
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan migrate
```

Запуск юнит тестов
```
docker-compose exec app vendor/bin/phpunit
```

*В корне проекта есть Postman коллекция для тестировния API*

*CTRL + O -> postman_collection.json*

## todo
* Добавить пагинацию для списка компаний
* Проверять аутентификацию не по input а по Bearer токену(заголовку)
