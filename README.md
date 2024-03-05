# Catalog app

Symfony based small application to parse table data from different sources and save them into internal storage.

NOTE: Current implementation is only available to work with xml on input data and persists them into database.

## Software

1. PHP 8.2
2. PostgreSQL 16.2
3. Symfony 6.4

# Installation

Docker should be installed before cloning project.
Install docker-compose command.

Clone current repository.
Build docker images using compose file from project directory:

``` bash
docker-compose -f compose.yaml up -d
```

Go inside your docker application container.

``` bash
docker-compose exec pcatalog sh
```

Make migration to DB from the first start

``` bash
php bin/console doctrine:migrations:migrate
```

Now everything is ready to run the parser application.
Follow next steps from this documentaion.

## Parse usage

To parse the file please follow the steps:

* Copy the xml based file into catalog ./data/upload directory inside the docker container.
* Then run the console command below inside the container.

Console command use 2 arguments:
1. Parser type: 'xml'
2. Saver type: 'db'

And with parser type 'xml' option parameter is expected:

1. '--filename' with value of relative path to the xml file

``` bash
php bin/console catalog:parse xml db --filename '<<path_to_filename>>'
```

Working example out of the box inside container, file was copied by into the docker image:

``` bash
php bin/console catalog:parse xml db --filename './upload/feed.xml'
```

## Run unit tests

### Inside the container

```bash
php bin/phpunit tests/unit
```
