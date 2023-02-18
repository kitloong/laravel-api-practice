# Article

https://medium.com/@kitloong/create-crud-rest-api-with-laravel-api-resource-3146d91b38b6

## Setup

This project uses [Sail](https://laravel.com/docs/sail).

Please install [Docker](https://www.docker.com) in order to start using Sail.

Install project dependencies:

```shell
composer install
```

Setup env:

```shell
cp .env.example .env
php artisan key:generate
```

Startup services:

```shell
./vendor/bin/sail up -d # Up on port 8080
```

PS: `.env` has been pre-configured to support MySQL and Redis from sail.

Check service status:

```
curl http://localhost:8080/api/health
```

Migrate and seed database:

```shell
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

### Swagger

Generate swagger page

```shell
./vendor/bin/sail artisan l5-swagger:generate
```

Open http://localhost:8080/api/documentation with your favourite browser to browse Swagger page.

## API example

### List

Route: `users.index`

```shell
curl http://localhost:8080/api/users \
     -H 'Accept: application/json'
```

### Get

Route: `users.show`

```shell
curl http://localhost:8080/api/users/1 \
     -H 'Accept: application/json'
```

### Create

Route: `users.store`

```shell
curl -X POST http://localhost:8080/api/users \
     -H 'Accept: application/json' \
     -H 'Content-Type: application/json' \
     -d $'{
         "name": "Name",
         "email": "test@email.com",
         "password": "password"
      }'
```

### Update

Route: `users.update`

```shell
curl -X PUT http://localhost:8080/api/users/1 \
     -H 'Accept: application/json' \
     -H 'Content-Type: application/json' \
     -d $'{
         "name": "Name",
         "email": "test@email.com"
      }'
```

### Delete

Route: `users.destroy`

```shell
curl -X DELETE http://localhost:8080/api/users/7 \
     -H 'Accept: application/json'
```
