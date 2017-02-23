Simple CRUD API with Symfony 3 and FOSRESTBundle
========================

This is an example of a very basic CRUD API using Symfony 3 and FOSRESTBundle.

Installation
============
Symfony-REST work with PHP 7 or later and MySQL 5.4 or later (please check requirements)

### From repository

Get Symfony-REST source files from GitHub repository:
```
git clone https://github.com/Konstyantin/Symfony-REST.git %path%
```

Download `composer.phar` to the project folder:
```
cd %path%
curl -s https://getcomposer.org/installer | php
```

Install composer dependencies with the following command:
```
php composer.phar install
```

Loading Fixtures
================
You can load fixtures via the command line by using the doctrine:fixtures:load command:
  
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
php bin/console doctrine:fixtures:load 
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
