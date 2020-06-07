## API Resource Routes

https://laravel.com/docs/7.x/controllers#restful-partial-resource-routes

## Eloquent: API Resources

https://laravel.com/docs/7.x/eloquent-resources

## API example

### List

Route: `users.index`

```shell script
curl http://localhost:8080/api/users \
     -H 'Accept: application/json'
```

### Get

Route: `users.show`

```shell script
curl http://localhost:8080/api/users/1 \
     -H 'Accept: application/json'
```

### Create

Route: `users.store`

```shell script
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

```shell script
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

```shell script
curl -X DELETE http://localhost:8080/api/users/7 \
     -H 'Accept: application/json'
```
