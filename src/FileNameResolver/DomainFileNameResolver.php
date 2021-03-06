<?php

namespace Ivoba\FaviconFetcher\FileNameResolver;


/**
 * Class DomainFileNameResolver
 * @package Ivoba\FaviconFetcher\FileNameResolver
 */
class DomainFileNameResolver implements FileNameResolverInterface
{

    private $prefix;
    private $suffix;

    public function __construct($prefix = '', $suffix = '')
    {
        $this->prefix = $prefix;
        $this->suffix = $suffix;
    }


    /**
     * @inheritdoc
     */
    public function get($url)
    {
        $parseUrl = parse_url(trim($url));
        $domain   = null;
        if (isset($parseUrl['host'])) {
            $domain = $parseUrl['host'];
        } elseif (isset($parseUrl['path'])) {
            $urlParts = explode('/', $parseUrl['path'], 2);
            $domain   = array_shift($urlParts);
        }

        if (is_null($domain)) {
            return null;
        }
        return $this->prefix . $domain . $this->suffix;
    }
} 