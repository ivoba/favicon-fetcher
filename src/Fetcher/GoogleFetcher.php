<?php

namespace Ivoba\FaviconFetcher\Fetcher;


/**
 * Uses the Google web service to fetch and convert a favicon to png
 *
 * Class GoogleFetcher
 * @package Ivoba\FaviconFetcher\Fetcher
 */
class GoogleFetcher extends WebServiceFetcher
{

    /**
     * @var string
     */
    private $defaultIconMd5 = 'b8a0bf372c762e966cc99ede8682bc71';

    /**
     * @var bool
     */
    private $skipDefaultImage;

    /**
     * @param string $url
     * @param bool   $skipDefaultIcon
     */
    function __construct($url = 'https://www.google.com/s2/favicons?domain=', $skipDefaultIcon = true)
    {
        $this->skipDefaultImage = $skipDefaultIcon;
        parent::__construct($url);
    }

    /**
     * @inheritdoc
     */
    public function fetch($url, $destination)
    {
        /*
         * doesnt find a favicon when there is no link tag for the favicon in the markup
         */
        try {
            $fetched = parent::fetch($url, $destination);
            if ($fetched) {
                if ($this->skipDefaultImage) {
                    $image = file_get_contents($destination);
                    if (md5($image) == $this->defaultIconMd5) {
                        unlink($destination);
                        return null;
                    }
                }
                return true;
            }
        } catch (\Exception $e) {

        }
        return null;
    }

    /**
     * @param string $defaultIconMd5
     */
    public function setDefaultIconMd5($defaultIconMd5)
    {
        $this->defaultIconMd5 = $defaultIconMd5;
    }

    /**
     * @param boolean $skipDefaultImage
     */
    public function setSkipDefaultImage($skipDefaultImage)
    {
        $this->skipDefaultImage = $skipDefaultImage;
    }

} 