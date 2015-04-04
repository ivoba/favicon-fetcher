<?php

namespace Ivoba\FaviconFetcher\Test\Converter;


use Ivoba\FaviconFetcher\Converter\ImageMagickIcoPngConverter;

class ImageMagickIcoPngConverterTest extends \PHPUnit_Framework_TestCase
{

    public function testConvert()
    {
        $converter   = new ImageMagickIcoPngConverter();
        $destination = __DIR__ . '/../Resources/favicon.ico';
        $generated   = $converter->convert(__DIR__ . '/../Resources/favicon.ico');
        $this->assertTrue($generated);
        $this->assertTrue(file_exists($destination));
    }

    protected function tearDown()
    {
        if (file_exists(__DIR__ . '/../Resources/favicon.png')) {
            unlink(__DIR__ . '/../Resources/favicon.png');
        }
    }
} 