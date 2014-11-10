<?php

namespace Ivoba\FaviconFetcher\FileNameResolver;


interface FileNameResolverInterface
{

    /**
     * @param $url
     * @return string filename
     */
    public function get($url);
} 