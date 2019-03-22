# Laravel JWT Simple API
Just a study project to test api creation with Laravel.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them

```
Docker
Docker Compose
```

### Installing
Run in the terminal

```
make up
```

This will up a PHP container and a MySQL container.

## Running the tests
Access the PHP container terminal:
```
make bash
```

Execute the tests:
```
./vendor/bin/phpunit
```

## API Documentation
[https://allangrds.github.io/Laravel-Simple-API/](https://allangrds.github.io/Laravel-Simple-API/)

## Built With

* [Laravel 5.8](https://laravel.com/)
* [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* [Docker](https://www.docker.com/)
* [Docker Compose](https://www.docker.com/)
* [Mysql 5.7](https://dev.mysql.com/downloads/mysql/5.7.html)
* [PHP 7.2](https://secure.php.net/releases/7_2_0.php)
* [MKDocs](https://www.mkdocs.org/)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details