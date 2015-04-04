Favicon Fetcher
====

Lib to fetch Favicon from a url and store it as PNG.
Its highly flexible. You can use your own Fetchers or FileNamerResolvers.
So it would also be possible to store it as gif, jpg or whatever.

[![Build Status](https://secure.travis-ci.org/ivoba/favicon-fetcher.png?branch=master)](http://travis-ci.org/ivoba/favicon-fetcher)
[![Dependency Status](https://www.versioneye.com/php/ivoba:favicon-fetcher/master/badge.png)](https://www.versioneye.com/php/ivoba:favicon-fetcher/master)
[![Latest Version](https://img.shields.io/github/release/ivoba/favicon-fetcher.svg?style=flat-square)](https://github.com/ivoba/favicon-fetcher/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/ivoba/favicon-fetcher.svg?style=flat-square)](https://scrutinizer-ci.com/g/ivoba/favicon-fetcher/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/ivoba/favicon-fetcher.svg?style=flat-square)](https://scrutinizer-ci.com/g/ivoba/favicon-fetcher)
[![Total Downloads](https://img.shields.io/packagist/dt/ivoba/favicon-fetcher.svg?style=flat-square)](https://packagist.org/packages/ivoba/favicon-fetcher)


## Installation

Via composer:

Add: ```php composer require ivoba/favicon-fetcher:~1.0```

And update it ```php composer update ivoba/favicon-fetcher```

## Usage
Use the static factory method to create the Fetcher with default settings:

    $fetcher = \Ivoba\FaviconFetcher\FaviconFetcher::create();

The default settings are:

- stores pngs in/tmp
- uses DomainFileNameResolver, which creates a filename based on the domain: github.com => github.com.png
- trys to fetch favicon by different webservices in this order:
  1. Google web service
  2. http://getfavicon.appspot.com (can be broken at times)
  3. Default Image
- if Google service doesnt deliver a converted png already, we create it ourselves via imagemagick on commandline

All components are exchangable via interfaces for custom requirements.

## Demo

    cd fetcher-dir
    php -S localhost:8080

type in your browser:

    http://localhost:8080/demo.php?favicon=facebook.com;twitter.com;unfuddle.com;packagist.org

You will see all favicons as png images.