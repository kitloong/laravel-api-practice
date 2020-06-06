# Docker

    docker-compose -p raktool up -d --build
    
## Run Next.js

To run next.js in the container, you need to exec into `nextjs` and run `yarn dev`

    docker-compose -p raktool exec nextjs
    yarn dev

## To browse

|Application|Localhost|
|---|---|
|Laravel|http://localhost:8080|
|Next.js|http://localhost:3030|
|MySQL|http://localhost:33061|

## To run command

    docker-compose -p raktool exec app php -v
    
## To start interactive bash

    docker-compose -p raktool exec app bash
