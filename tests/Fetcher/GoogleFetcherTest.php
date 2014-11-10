<?php

namespace Ivoba\FaviconFetcher;


use Ivoba\FaviconFetcher\Fetcher\GoogleFetcher;

class GoogleFetcherTest extends \PHPUnit_Framework_TestCase
{
    public function testFetch()
    {
        $fetcher     = new GoogleFetcher();
        $destination = __DIR__ . '/../Resources/new_google_favicon.png';
        $generated   = $fetcher->fetch('github.com', $destination);
        $this->assertTrue($generated);
        $this->assertTrue(file_exists($destination));
    }

    public function testSkipDefaultIcon(){
        $fetcher     = new GoogleFetcher();
        $destination = __DIR__ . '/../Resources/bogus_google_favicon.png';
        $generated   = $fetcher->fetch('nononononono', $destination);
        $this->assertNull($generated);
        $this->assertFalse(file_exists($destination));
    }

    public function testDontSkipDefaultIcon(){
        $fetcher     = new GoogleFetcher();
        $fetcher->setSkipDefaultImage(false);
        $destination = __DIR__ . '/../Resources/default_google_favicon.png';
        $generated   = $fetcher->fetch('nononononono', $destination);
        $this->assertTrue($generated);
        $this->assertTrue(file_exists($destination));
    }
    
    protected function tearDown()
    {
        if (file_exists(__DIR__ . '/../Resources/new_google_favicon.png')) {
            unlink(__DIR__ . '/../Resources/new_google_favicon.png');
        }
        if (file_exists(__DIR__ . '/../Resources/default_google_favicon.png')) {
            unlink(__DIR__ . '/../Resources/default_google_favicon.png');
        }
    }
} 