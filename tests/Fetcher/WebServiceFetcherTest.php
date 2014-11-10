<?php

namespace Ivoba\FaviconFetcher;


use Ivoba\FaviconFetcher\Fetcher\WebServiceFetcher;

class WebServiceFetcherTest extends \PHPUnit_Framework_TestCase
{

    public function testFetch()
    {
        $fetcher     = new WebServiceFetcher('https://www.google.com/s2/favicons?domain=');
        $destination = __DIR__ . '/../Resources/new_default_favicon.png';
        $generated   = $fetcher->fetch('http://github.com', $destination);
        $this->assertTrue($generated);
        $this->assertTrue(file_exists($destination));
    }

    protected function tearDown()
    {
        if (file_exists(__DIR__ . '/../Resources/new_default_favicon.png')) {
            unlink(__DIR__ . '/../Resources/new_default_favicon.png');
        }
    }
} 