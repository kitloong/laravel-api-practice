# Article

https://medium.com/@kitloong/create-crud-rest-api-with-laravel-api-resource-3146d91b38b6

## Setup

```shell
./vendor/bin/sail up -d # Up on port 8080

./vendor/bin/sail composer install

./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

## Swagger

```shell
./vendor/bin/sail artisan l5-swagger:generate # Generate

# Browse http://localhost:8080/api/documentation
```

## API Resource Routes

https://laravel.com/docs/8.x/controllers#restful-partial-resource-routes

## Eloquent: API Resources

https://laravel.com/docs/8.x/eloquent-resources

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
