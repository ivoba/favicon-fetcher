<?php

namespace Ivoba\FaviconFetcher\Fetcher;


use Ivoba\FaviconFetcher\Converter\IcoConverterInterface;

/**
 * Class GetFaviconFetcher
 * @package Ivoba\FaviconFetcher\Fetcher
 */
class GetFaviconFetcher extends WebServiceFetcher
{

    /**
     * @var \Ivoba\FaviconFetcher\Converter\IcoConverterInterface
     */
    private $converter;

    /**
     * @var bool
     */
    private $skipDefaultImage;

    /**
     * @param string $url
     * @param IcoConverterInterface $converter
     * @param bool $skipDefaultIcon
     */
    function __construct($url = 'https://getfavicon.appspot.com/', IcoConverterInterface $converter = null, $skipDefaultIcon = true)
    {
        $this->skipDefaultImage = $skipDefaultIcon;
        $this->converter        = $converter;
        parent::__construct($url);
    }

    /**
     * @inheritdoc
     */
    public function fetch($url, $destination)
    {
        /* needs fully quallified url e.q with http:// */

        if ($this->skipDefaultImage) {
            $url .= '?defaulticon=none';
            //        none: no default icon will be returned (and an HTTP 204 "No content" response code)
        }

        try {
            $ch = parent::fetch($url, $destination);
            if ($ch && $this->converter) {
                //convert to png
                return $this->converter->convert($destination);
            }
            return $ch;
        } catch (\Exception $e) {
        }
        return null;
    }

    /**
     * @param boolean $skipDefaultImage
     */
    public function setSkipDefaultImage($skipDefaultImage)
    {
        $this->skipDefaultImage = $skipDefaultImage;
    }

    /**
     * @param \Ivoba\FaviconFetcher\Converter\IcoConverterInterface $converter
     */
    public function setConverter(IcoConverterInterface $converter)
    {
        $this->converter = $converter;
    }


} 