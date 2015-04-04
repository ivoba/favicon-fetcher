<?php

namespace Ivoba\FaviconFetcher\Fetcher;

/**
 * Interface FetcherInterface
 * @package Ivoba\Favicon_Fetcher\Fetcher
 */
interface FetcherInterface
{

    /**
     * @param $url
     * @param $destination
     * @return bool|null
     */
    public function fetch($url, $destination);

} 