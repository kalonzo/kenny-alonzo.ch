# Lab4tech people symfony 4 project 

[TODO] short project description

# DOCKER 

## Docker compose comes with 5 containers
* web - an apache/php container. (http://localhost:8080)
* mysql - mysql database container
* phpmyadmin - database administation container (http://localhost:8081)
* adminer - database administration container (http://localhost:8082)
* encore - webpack realtime compiler for assets

## Install project and run containers

1. Install [docker]
1. Install [git]
1. Clone this repository and go to it 
1. Run containers: `docker-compose up -d`
1. Wait until all containers are up (could be long on first run)

You can follow progress on watching logs:
```
docker-compose logs -f web
docker-compose logs -f mysql
```
## Install dependencies

1. Log into web container: `docker-compose exec web bash`
1. Install symfony dependencies: `composer update`
1. Install node dependencies: `yarn`
1. Exit console `exit`

## Migrate database
1. Log into web container: `docker-compose exec web bash`
1. Migrate database: `php bin/console doctrine:migration:migrate`
1. Exit console: `exit`


## Usage

### Access containers
* web site - http://localhost:8080
* phpmyadmin - http://localhost:8081
* adminer - http://localhost:8082

### Most used docker commands

* Run containers: `docker-compose up -d`
* Go into container: `docker-compose exec ${CONTAINER_NAME} bash`
* See container logs: `docker-compose logs -f ${CONTAINER_NAME}`
* To stop server: `docker-compose down`

You can find more docker commands on [docker-cli] and [docker-compose-cli]



### Testing
Go into web container and run tests
```
docker-compose exec web bash
php bin/phpunit
```


# NO DOCKER

## Installation

### Windows 10 Pro x64

## WampServer Version 3.1.0 64bit Installation
 
Download & install from https://sourceforge.net/projects/wampserver/ proced install with PHP 7.1.9 and use MySQL for database server.
 
## Symfony dependency installation 

1. Download & run Composer-Setup.exe from https://getcomposer.org/doc/00-intro.md . For test composer type `composer` on a CMD
2. Donwnload & run node-v8.12.0-x64 from https://nodejs.org/en/ 
3. Donwnload & run yarn-1.10.1.msi from https://yarnpkg.com/lang/en/docs/install/#windows-stable 
4. Download & run Git-2.19.1-64-bit.exe from https://gitforwindows.org/ this will install dependency for git project and better termina than classic CMD goes not store your command more than 3 input

## Installing & Setting up the Symfony Framework
1. With CMD or Git Bash change to your 'www' directory by typing `cd C:\wamp64\www`
2. ran composer command `composer create-project symfony/website-skeleton my-project` .

## Confuguring a Apache Server 
1. type `composer require symfony/apache-pack` for run recipe from symfony (install necessary lib in you Apapche)
2. Add this block to your C:\wamp64\bin\apache\apache2.4.27\conf\extra\httpd-vhosts.conf Alias to point your 'public' folder of Symfony project

```Apache  
Alias /people-symfony "${INSTALL_DIR}/www/my-project/public"
  <Directory "${INSTALL_DIR}/www/my-project/public">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
```


## Configuring Smfony project dependency

For Encore (JS/css/Jquery)
First browse to your my-project directory with GIT bash and run 
1. `composer require symfony/webpack-encore-pack`
2. `yarn install`. 

For Doctrine (Database)
1. `composer require symfony/orm-pack` 
2. `composer require symfony/maker-bundle --dev` 

## Access (accesible from local network with your ip)

* Web: http://localhost
* Symfony project: http://localhost/people-symfony
* PhpMyAdmin: http://localhost/phpmyadmin

[Download full docx documention](./documentation/documentation.docx)

<!---
external links used in this document
-->
[docker]: https://www.docker.com/get-started
[docker-cli]: https://docs.docker.com/engine/reference/commandline/cli/
[docker-compose-cli]:https://docs.docker.com/compose/reference/
[git]: https://git-scm.com/downloads

