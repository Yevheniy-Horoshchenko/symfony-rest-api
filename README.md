# REST API Application — Chess Openings

## Description:

CRUD functionality for chess openings.
You can add your own openings or retrieve existing ones.
User registration and authentication are implemented.

## Technology Stack:

PHP 8.4,
Symfony,
MySQL,
PhpMyAdmin,
Docker,
Composer

## Installation & Setup:

1. Clone the repository
   
    `git clone git@github.com:Yevheniy-Horoshchenko/symfony-rest-api.git project-folder`
  
    `cd project-folder`

2. Build Docker images
   
   `docker-compose build`

3. Start containers
   
   `docker-compose up -d`

## Database Fixtures:

The project includes database fixtures for chess openings
  
To load fixtures:

`php bin/console doctrine:fixtures:load --append`
