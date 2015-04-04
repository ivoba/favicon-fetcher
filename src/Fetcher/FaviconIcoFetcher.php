<?php

namespace Ivoba\FaviconFetcher\Fetcher;

use Ivoba\FaviconFetcher\Converter\IcoConverterInterface;


/**
 * just tries to fetch /favicon.ico
 * useful when other fetchers dont find an icon because of wrong link tag
 *
 * Class FaviconIcoFetcher
 * @package Ivoba\FaviconFetcher\Fetcher
 */
class FaviconIcoFetcher implements FetcherInterface
{

    /**
     * @var \Ivoba\FaviconFetcher\Converter\IcoConverterInterface
     */
    private $converter;

    public function __construct(IcoConverterInterface $converter = null)
    {
        $this->converter = $converter;
    }


    /**
     * @param $url
     * @param $destination
     * @return bool|null
     */
    public function fetch($url, $destination)
    {
        try {
            $ret = null;
            $url = $this->addhttp($url);
            $ch  = curl_init($url . '/favicon.ico');
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $contents = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode == 200) {
                $fp = fopen($destination, 'w+');
                fwrite($fp, $contents);
                fclose($fp);
                $ret = true;
                if ($this->converter) {
                    $ret = $this->converter->convert($destination);
                }
            }
            curl_close($ch);
            return $ret;
        } catch (\Exception $e) {
            // hmm ok, let the next Fetcher try its luck
        }
        return null;
    }

    private function addhttp($url)
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
} 