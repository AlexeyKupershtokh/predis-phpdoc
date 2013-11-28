alexey-kupershtokh/predis-phpdoc
================================

IDE Autocompletion for [Predis](https://github.com/nrk/predis).

Packagist: [alexey-kupershtokh/predis-phpdoc](https://packagist.org/packages/alexey-kupershtokh/predis-phpdoc).

This package was inspired by [ukko/phpredis-phpdoc](https://github.com/ukko/phpredis-phpdoc) which was also used as initial source of documentation. Though it was heavily lowercased, fixed and extended in order to comply with Predis.

Installation
------------
```bash
php composer.phar require alexey-kupershtokh/predis-phpdoc '*'
```

For configuring IDEs check this page: https://github.com/ukko/phpredis-phpdoc

Usage
-----
```php
/** @var \PredisPhpdoc\Client $client */
$client = new \Predis\Client();
$client->
```
