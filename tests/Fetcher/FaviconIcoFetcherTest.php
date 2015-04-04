<?php

namespace Ivoba\FaviconFetcher\Test;


use Ivoba\FaviconFetcher\Converter\ImageMagickIcoPngConverter;
use Ivoba\FaviconFetcher\Fetcher\FaviconIcoFetcher;

class FaviconIcoFetcherTest extends \PHPUnit_Framework_TestCase
{
    public function testFetch()
    {
        $fetcher     = new FaviconIcoFetcher(new ImageMagickIcoPngConverter());
        $destination = __DIR__ . '/../Resources/new_faviconico_favicon.ico';
        $png         = __DIR__ . '/../Resources/new_faviconico_favicon.png';
        $generated   = $fetcher->fetch('http://github.com', $destination);
        $this->assertTrue($generated);
        $this->assertTrue(file_exists($png));
    }

    protected function tearDown()
    {
        if (file_exists(__DIR__ . '/../Resources/new_faviconico_favicon.png')) {
            unlink(__DIR__ . '/../Resources/new_faviconico_favicon.png');
        }
        if (file_exists(__DIR__ . '/../Resources/new_faviconico_favicon.ico')) {
            unlink(__DIR__ . '/../Resources/new_faviconico_favicon.ico');
        }
    }
} 