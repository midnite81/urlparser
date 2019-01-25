# Url Parser [![Latest Stable Version](https://poser.pugx.org/midnite81/urlparser/version)](https://packagist.org/packages/midnite81/urlparser) [![Total Downloads](https://poser.pugx.org/midnite81/urlparser/downloads)](https://packagist.org/packages/midnite81/urlparser) [![Latest Unstable Version](https://poser.pugx.org/midnite81/urlparser/v/unstable)](https://packagist.org/packages/midnite81/urlparser) [![License](https://poser.pugx.org/midnite81/urlparser/license.svg)](https://packagist.org/packages/midnite81/urlparser) [![Build](https://travis-ci.org/midnite81/urlparser.svg?branch=master)](https://travis-ci.org/midnite81/urlparser) [![Coverage Status](https://coveralls.io/repos/github/midnite81/urlparser/badge.svg?branch=master)](https://coveralls.io/github/midnite81/urlparser?branch=master)
A PHP 7.1+ URL parser for easy manipulation of URLs

# Installation

This package requires PHP 7.1+.

To install through composer include the package in your `composer.json`.

    "midnite81/urlparser": "^1.0"

Run `composer install` or `composer update` to download the dependencies or you can run 
`composer require midnite81/urlparser`.

# Example Usage

```php
<?php 

include '/path/to/vendor/autoload.php';

$url = new Midnite81\UrlParser\Url('http://example.com/gallery/houses?hiRes=1#forSale');

echo $url->path(); // returns '/gallery/houses'
```

# Available Methods

|Method|Returns|Description|
|:-----|:-----|:-----|
|all()|array|Returns all parts of the URL as an array|
|json()|json|Returns all parts of the URL as a JSON object|
|get(string $key)|string or null|Returns the value of a URL part, if it exists|
|scheme()|string|Returns the scheme e.g. http|
|host()|string|Returns the host e.g example.com|
|port()|string|Returns the port e.g. 80|
|user()|string|Returns the user|
|pass()|string|Returns the password|
|path()|string|Returns the path e.g. /gallery/houses|
|query(bool $includeQuestionMark = false)|string|Returns the querystring e.g. hiRes=1|
|fragment(bool $includeHash = false)|string|Returns the fragment e.g forSale|
|segments()|array|Returns each segment of the URL path|
|segment(int $index)|string or null|Returns the requested segment of the URL Path, if it exists|
|encode(int $times = 1)|string|Returns the url encoded (urlencode).|
|doubleEncode()|string|Returns the url double encoded|
|queryArray()|array|Returns the Query String back in an associative array|
|fragmentArray()|array|Returns the Fragments back in an associative array|
|getQueryValue(string $key)|string or null|Returns the value of the query string key if it exists|
|getHashValue(string $key)|string or null|Returns the value of the fragment/hash key if it exists|
