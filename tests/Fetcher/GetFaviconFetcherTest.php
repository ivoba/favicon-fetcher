<?php

namespace Ivoba\FaviconFetcher\Test;

use Ivoba\FaviconFetcher\Converter\ImageMagickIcoPngConverter;
use Ivoba\FaviconFetcher\Fetcher\GetFaviconFetcher;

class GetFaviconFetcherTest extends \PHPUnit_Framework_TestCase
{
    public function testFetch()
    {
        $this->markTestSkipped('GetfaviconFetcher on appspot seems broken.');
        $fetcher     = new GetFaviconFetcher();
        $destination = __DIR__ . '/../Resources/new_getfavicon_favicon.ico';
        $generated   = $fetcher->fetch('http://github.com', $destination);
        $this->assertTrue($generated);
        $this->assertTrue(file_exists($destination));
    }

    public function testFetchAndConvert()
    {
        $this->markTestSkipped('GetfaviconFetcher on appspot seems broken.');
        $fetcher = new GetFaviconFetcher();
        $fetcher->setConverter(new ImageMagickIcoPngConverter());
        $destination = __DIR__ . '/../Resources/new_getfavicon_favicon.ico';
        $png         = __DIR__ . '/../Resources/new_getfavicon_favicon.png';
        $generated   = $fetcher->fetch('http://github.com', $destination);
        $this->assertTrue($generated);
        $this->assertTrue(file_exists($png));
    }

    public function testSkipDefaultIcon()
    {
        $fetcher     = new GetFaviconFetcher();
        $destination = __DIR__ . '/../Resources/bogus_getfavicon_favicon.ico';
        $generated   = $fetcher->fetch('nononononono', $destination);
        $this->assertNull($generated);
        $this->assertFalse(file_exists($destination));
    }

    protected function tearDown()
    {
        if (file_exists(__DIR__ . '/../Resources/new_getfavicon_favicon.ico')) {
            unlink(__DIR__ . '/../Resources/new_getfavicon_favicon.ico');
        }
        if (file_exists(__DIR__ . '/../Resources/new_getfavicon_favicon.png')) {
            unlink(__DIR__ . '/../Resources/new_getfavicon_favicon.png');
        }
        if (file_exists(__DIR__ . '/../Resources/default_getfavicon_favicon.ico')) {
            unlink(__DIR__ . '/../Resources/default_getfavicon_favicon.ico');
        }
    }
} 