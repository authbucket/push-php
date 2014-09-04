AuthBucket\\Push
================

[![Build
Status](https://travis-ci.org/authbucket/push-php.svg?branch=master)](https://travis-ci.org/authbucket/push-php)
[![Coverage
Status](https://img.shields.io/coveralls/authbucket/push-php.svg)](https://coveralls.io/r/authbucket/push-php?branch=master)
[![Dependency
Status](https://www.versioneye.com/php/authbucket:push-php/dev-master/badge.svg)](https://www.versioneye.com/php/authbucket:push-php/dev-master)
[![Latest Stable
Version](https://poser.pugx.org/authbucket/push-php/v/stable.svg)](https://packagist.org/packages/authbucket/push-php)
[![Total
Downloads](https://poser.pugx.org/authbucket/push-php/downloads.svg)](https://packagist.org/packages/authbucket/push-php)
[![License](https://poser.pugx.org/authbucket/push-php/license.svg)](https://packagist.org/packages/authbucket/push-php)

The primary goal of [AuthBucket\\Push](http://push-php.authbucket.com/)
is to develop a library for sending out push notifications to mobile
devices; secondary goal would be develop corresponding wrapper [Symfony2
Bundle](http://symfony.com) and [Drupal module](https://www.drupal.org).

This library bundle with a [Silex](http://silex.sensiolabs.org/) based
[AuthBucketPushServiceProvider](https://github.com/authbucket/push-php/blob/master/src/AuthBucket/Push/Provider/AuthBucketPushServiceProvider.php)
for unit test and demo purpose. Installation and usage can refer as
below.

Demo
----

The demo is based on [Silex](http://silex.sensiolabs.org/) and
[AuthBucketPushServiceProvider](https://github.com/authbucket/push-php/blob/master/src/AuthBucket/Push/Provider/AuthBucketPushServiceProvider.php).
Read though [Demo](http://push-php.authbucket.com/demo) for more
information.

You may also run the demo locally. Open a console and execute the
following command to install the latest version in the `push-php`
directory:

    $ composer create-project authbucket/push-php push-php "~0.0"

Then use the PHP built-in web server to run the demo application:

    $ cd push-php
    $ php app/console server:run

If you get the error
`There are no commands defined in the "server" namespace.`, then you are
probably using PHP 5.3. That's ok! But the built-in web server is only
available for PHP 5.4.0 or higher. If you have an older version of PHP
or if you prefer a traditional web server such as Apache or Nginx, read
the [Configuring a web
server](http://silex.sensiolabs.org/doc/web_servers.html) article.

Open your browser and access the <http://127.0.0.1:8000> URL to see the
Welcome page of demo application.

Also access <http://127.0.0.1:8000/admin/refresh_database> to initialize
the bundled SQLite database with user account `admin`:`secrete`.

Documentation
-------------

Push's documentation is built with
[Sami](https://github.com/fabpot/Sami) and publicly hosted on [GitHub
Pages](http://authbucket.github.io/push-php).

To built the documents locally, execute the following command:

    $ vendor/bin/sami.php update .sami.php

Open `build/sami/index.html` with your browser for the documents.

Tests
-----

This project is coverage with [PHPUnit](http://phpunit.de/) test cases;
CI result can be found from [Travis
CI](https://travis-ci.org/authbucket/push-php); code coverage report can
be found from [Coveralls](https://coveralls.io/r/authbucket/push-php).

To run the test suite locally, execute the following command:

    $ vendor/bin/phpunit

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

-   Code released under
    [MIT](https://github.com/authbucket/push-php/blob/master/LICENSE)
-   Docs released under [CC BY-NC-SA
    3.0](http://creativecommons.org/licenses/by-nc-sa/3.0/)
