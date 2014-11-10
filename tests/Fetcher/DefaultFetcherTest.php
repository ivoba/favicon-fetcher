<?php
namespace Ivoba\FaviconFetcher;

use Ivoba\FaviconFetcher\Fetcher\DefaultFetcher;

class DefaultFetcherTest extends \PHPUnit_Framework_TestCase
{

    public function testFetch()
    {
        $fetcher     = new DefaultFetcher(__DIR__ . '/../Resources/default_favicon_image.png');
        $destination = __DIR__ . '/../Resources/new_default_favicon.png';
        $generated   = $fetcher->fetch('http://dingdong.de', $destination);
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