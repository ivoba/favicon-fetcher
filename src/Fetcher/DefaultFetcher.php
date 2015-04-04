<?php

namespace Ivoba\FaviconFetcher\Fetcher;

/**
 * save a default favicon image
 *
 * Class DefaultFetcher
 * @package Ivoba\Favicon_Fetcher\Fetcher
 */
class DefaultFetcher implements FetcherInterface
{

    /**
     * @var
     */
    private $defaultImg;

    /**
     * @param string $defaultImg image with full path
     */
    public function __construct($defaultImg)
    {
        $this->defaultImg = $defaultImg;
    }

    /**
     * @inheritdoc
     */
    public function fetch($url, $destination)
    {
        return copy($this->defaultImg, $destination);
    }

} 