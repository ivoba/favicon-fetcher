<?php

namespace Ivoba\FaviconFetcher\Fetcher;


/**
 * Class WebServiceFetcher
 * @package Ivoba\FaviconFetcher\Fetcher
 */
class WebServiceFetcher implements FetcherInterface
{

    /**
     * @var
     */
    protected $url;

    /**
     * @param $url
     */
    function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @inheritdoc
     */
    public function fetch($url, $destination)
    {
        try {
            $ret = null;
            $ch = curl_init($this->url . $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $contents = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ( $httpCode == 200 ) {
                $fp = fopen($destination, 'w+');
                fwrite($fp, $contents);
                fclose($fp);
                $ret = true;
            }
            curl_close($ch);
            return $ret;
        } catch (\Exception $e) {

        }
        return null;
    }
} 