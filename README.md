# PGI

Patient global index system made with laravel framework

## Prerequisite

the only prerequisite for our app is

-   **Docker**

## env setup

copy .env.example and rename it .env

## installing dependencies

```
docker run --rm -v $(pwd):/app composer install --ignore-platform-req=ext-exif
```

## get up the system

```
./vendor/bin/sail up
```

## migrate the database using

```
./vendor/bin/sail php artisan migrate --seed
```

## last step

system is up and running now you can go to the below url to test it

```
http://localhost:9001
```

## system is already up and working on the below url if you do not want to do all the above configs

http://alb-5vuzizdmjzcvjttcp8.me-central-1.alb.aliyuncs.com/
