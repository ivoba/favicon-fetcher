<?php

namespace Ivoba\FaviconFetcher;

use Ivoba\FaviconFetcher\Converter\ImageMagickIcoPngConverter;
use Ivoba\FaviconFetcher\Fetcher\DefaultFetcher;
use Ivoba\FaviconFetcher\Fetcher\FetcherInterface;
use Ivoba\FaviconFetcher\Fetcher\GetFaviconFetcher;
use Ivoba\FaviconFetcher\Fetcher\GoogleFetcher;
use Ivoba\FaviconFetcher\FileNameResolver\DomainFileNameResolver;
use Ivoba\FaviconFetcher\FileNameResolver\FileNameResolverInterface;

/**
 * Class FaviconFetcher
 * @package Ivoba\FaviconFetcher
 */
class FaviconFetcher
{

    /**
     * @var array
     */
    private $fetchers;

    /**
     * @var string
     */
    private $imageDir;

    /**
     * @var FileNameResolver\DomainFileNameResolver|FileNameResolver\FileNameResolverInterface
     */
    private $fileNameResolver;

    /**
     * @param array $fetchers
     * @param FileNameResolverInterface $fileNameResolver
     * @param string $imageDir
     */
    function __construct(array $fetchers,
                         FileNameResolverInterface $fileNameResolver = null,
                         $imageDir = '/tmp/')
    {
        $this->fetchers = $fetchers;
        $this->imageDir = $imageDir;
        if (is_null($fileNameResolver)) {
            $fileNameResolver = new DomainFileNameResolver();
        }
        $this->fileNameResolver = $fileNameResolver;
    }

    /**
     * @param array $urls
     * @return array
     */
    public function fetch(array $urls)
    {
        $images = [];
        foreach ($urls as $url) {
            $name = $this->fileNameResolver->get($url);
            if ($name) {
                $destination = $this->imageDir . $name;
                foreach ($this->fetchers as $fetcher) {
                    $favicon = $fetcher->fetch($url, $destination);
                    if ($favicon) {
                        $images[$url] = $destination;
                        break;
                    }
                }
            }
        }
        return $images;
    }

    /**
     * @param FetcherInterface $fetcher
     */
    public function addFetcher(FetcherInterface $fetcher)
    {
        $this->fetcher[] = $fetcher;
    }

    /**
     * @param string $imageDir
     * @param null $defaultImg
     * @return FaviconFetcher
     */
    public static function create($imageDir = '/tmp/', $defaultImg = null)
    {
        if (is_null($defaultImg) || !file_exists($defaultImg)) {
            $defaultImg = __DIR__ . '/../tests/Resources/default_favicon_image.png';
        }
        $getFaviconService = new GetFaviconFetcher();
        $getFaviconService->setConverter(new ImageMagickIcoPngConverter());
        return new self([new GoogleFetcher(),
                            $getFaviconService,
                            new DefaultFetcher($defaultImg)],
                        new DomainFileNameResolver($prefix = '', $suffix = '.png'),
                        $imageDir);
    }

} 