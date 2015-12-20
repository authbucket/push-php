AuthBucket\\Push
================

[![Build Status](https://travis-ci.org/authbucket/push-php.svg?branch=master)](https://travis-ci.org/authbucket/push-php)
[![Coverage Status](https://coveralls.io/repos/authbucket/push-php/badge.svg?branch=master&service=github)](https://coveralls.io/github/authbucket/push-php?branch=master)
[![Dependency Status](https://www.versioneye.com/php/authbucket:push-php/dev-master/badge.svg)](https://www.versioneye.com/php/authbucket:push-php/dev-master)
[![Latest Stable Version](https://poser.pugx.org/authbucket/push-php/v/stable.svg)](https://packagist.org/packages/authbucket/push-php)
[![Total Downloads](https://poser.pugx.org/authbucket/push-php/downloads.svg)](https://packagist.org/packages/authbucket/push-php)
[![License](https://poser.pugx.org/authbucket/push-php/license.svg)](https://packagist.org/packages/authbucket/push-php)

The primary goal of [AuthBucket\\Push](http://push-php.authbucket.com/) is to develop a library for sending out push notifications to mobile devices; secondary goal would be develop corresponding wrapper [Symfony2 Bundle](http://symfony.com) and [Drupal module](https://www.drupal.org).

This library bundle with a [Silex](http://silex.sensiolabs.org/) based [AuthBucketPushServiceProvider](https://github.com/authbucket/push-php/blob/master/src/Provider/AuthBucketPushServiceProvider.php) for unit test and demo purpose. Installation and usage can refer as below.

Installation
------------

Simply add a dependency on `authbucket/push-php` to your project's `composer.json` file if you use [Composer](http://getcomposer.org/) to manage the dependencies of your project.

Here is a minimal example of a `composer.json`:

    {
        "require": {
                "authbucket/push-php": "~3.0"
        }
    }

### Parameters

The bundled [AuthBucketPushServiceProvider](https://github.com/authbucket/push-php/blob/master/src/Provider/AuthBucketPushServiceProvider.php) come with following parameters:

-   `authbucket_push.model`: (Optional) Override this with your own model classes, default with in-memory AccessToken for using resource firewall with remote debug endpoint.
-   `authbucket_push.model_manager.factory`: (Optional) Override this with your backend model managers, e.g. Doctrine ORM EntityRepository, default with in-memory implementation for using resource firewall with remote debug endpoint.

### Services

The bundled [AuthBucketPushServiceProvider](https://github.com/authbucket/push-php/blob/master/src/Provider/AuthBucketPushServiceProvider.php) come with following services controller which simplify the Push controller implementation overhead:

-   `authbucket_push.push_controller`: Push endpoint controller.

### Registering

If you are using [Silex](http://silex.sensiolabs.org/), register [AuthBucketPushServiceProvider](https://github.com/authbucket/push-php/blob/master/src/Provider/AuthBucketPushServiceProvider.php) as below:

    $app->register(new AuthBucket\Push\Provider\AuthBucketPushServiceProvider());

Moreover, enable following service providers if that's not already the case:

    $app->register(new AuthBucket\OAuth2\Provider\AuthBucketOAuth2ServiceProvider());
    $app->register(new Silex\Provider\MonologServiceProvider());
    $app->register(new Silex\Provider\SecurityServiceProvider());
    $app->register(new Silex\Provider\ValidatorServiceProvider());

Demo
----

The demo is based on [Silex](http://silex.sensiolabs.org/) and [AuthBucketPushServiceProvider](https://github.com/authbucket/push-php/blob/master/src/Provider/AuthBucketPushServiceProvider.php). Read though [Demo](http://push-php.authbucket.com/demo) for more information.

You may also run the demo locally. Open a console and execute the following command to install the latest version in the `push-php` directory:

    $ composer create-project authbucket/push-php authbucket/push-php "~1.0"

Then use the PHP built-in web server to run the demo application:

    $ cd authbucket/push-php
    $ ./app/console server:run

If you get the error `There are no commands defined in the "server" namespace.`, then you are probably using PHP 5.3. That's ok! But the built-in web server is only available for PHP 5.4.0 or higher. If you have an older version of PHP or if you prefer a traditional web server such as Apache or Nginx, read the [Configuring a web server](http://silex.sensiolabs.org/doc/web_servers.html) article.

Open your browser and access the <http://127.0.0.1:8000> URL to see the Welcome page of demo application.

Also access <http://127.0.0.1:8000/admin/refresh_database> to initialize the bundled SQLite database with user account `admin`:`secrete`.

Documentation
-------------

Push's documentation is built with [Sami](https://github.com/fabpot/Sami) and publicly hosted on [GitHub Pages](http://authbucket.github.io/push-php).

To built the documents locally, execute the following command:

    $ composer sami

Open `build/sami/index.html` with your browser for the documents.

Tests
-----

This project is coverage with [PHPUnit](http://phpunit.de/) test cases; CI result can be found from [Travis CI](https://travis-ci.org/authbucket/push-php); code coverage report can be found from [Coveralls](https://coveralls.io/r/authbucket/push-php).

To run the test suite locally, execute the following command:

    $ composer phpunit

Open `build/logs/html` with your browser for the coverage report.

References
----------

-   [Demo](http://push-php.authbucket.com/demo)
-   [API](http://authbucket.github.io/push-php/)
-   [GitHub](https://github.com/authbucket/push-php)
-   [Packagist](https://packagist.org/packages/authbucket/push-php)
-   [Travis CI](https://travis-ci.org/authbucket/push-php)
-   [Coveralls](https://coveralls.io/r/authbucket/push-php)

License
-------

-   Code released under [MIT](https://github.com/authbucket/push-php/blob/master/LICENSE)
-   Docs released under [CC BY 4.0](http://creativecommons.org/licenses/by/4.0/)
