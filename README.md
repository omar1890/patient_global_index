# PGI

Patient global index system made with laravel framework

## Prerequisite
the only prerequisite for our app is
- **Docker**

## env setup
copy .env.example and rename it .env

## configure your database in .env

you should fill up the below variables

```
DB_CONNECTION="mysql"
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

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

http://8.213.24.151/


