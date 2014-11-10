Favicon Fetcher
====

Lib to fetch Favicon from a url and store it as PNG.
Its highly flexible. You can use your own Fetchers or FileNamerResolvers.
So its also possible to store it as gif, jpg or whatever.

## Installation

Via composer:

Add: ```php composer require ivoba/favicon-fetcher:~1.0```.

And update it ```php composer update ivoba/favicon-fetcher```.

## Usage
Use the static factory method to create the Fetcher with default settings:

    $fetcher = \Ivoba\FaviconFetcher\FaviconFetcher::create();

The default settings are:

- stores pngs in/tmp
- uses DomainFileNameResolver, which creates a filename based on the domain: github.com => github.com.png
- trys to fetch favicon by different webservices in this order: 1. Google web service 2. http://getfavicon.appspot.com/ 3. Default Image
- if Google service doesnt deliver a converted png already, we create it ourselves via imagemagick on commandline

All components are exchangable via interfaces for custom requirements.

## Demo

    cd fetcher-dir
    php -S localhost:8080

type in your browser:

    http://localhost:8080/demo.php?favicon=facebook.com;twitter.com;unfuddle.com;packagist.org

You will see all favicons as png images.