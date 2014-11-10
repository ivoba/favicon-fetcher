<?php

namespace Ivoba\FaviconFetcher;


class FaviconFetcherTest extends \PHPUnit_Framework_TestCase
{

    public function testFetch()
    {
        $fetcher   = FaviconFetcher::create(__DIR__ . '/Resources/');
        $generated = $fetcher->fetch(['https://github.com', //normal
                                     'facebook.com', //default no link tag should deliever
                                     'https://unfuddle.com',
                                     'twitter.com']
        );
        $this->assertEquals(['https://github.com' => __DIR__ . '/Resources/github.com.png',
                             'facebook.com' => __DIR__ . '/Resources/facebook.com.png',
                             'https://unfuddle.com' => __DIR__ . '/Resources/unfuddle.com.png',
                             'twitter.com' => __DIR__ . '/Resources/twitter.com.png'],
                            $generated);
        $this->assertTrue(file_exists(__DIR__ . '/Resources/github.com.png'));
    }

    protected function tearDown()
    {
        if (file_exists(__DIR__ . '/../Resources/github.com.png')) {
            unlink(__DIR__ . '/../Resources/github.com.png');
        }
    }
} 