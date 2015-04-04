<?php

namespace Ivoba\FaviconFetcher\Converter;


/**
 * Class ImageMagickIcoPngConverter
 * @package Ivoba\FaviconFetcher\Converter
 */
class ImageMagickIcoPngConverter implements IcoConverterInterface
{
    /**
     * @param $file
     * @return bool|null
     */
    public function convert($file)
    {
        if (!is_file($file)) {
            return null;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $info  = finfo_file($finfo, $file);
        if ($info == 'inode/x-empty') {
            return null;
        }

        $path = pathinfo($file);
        $png  = $path['dirname'] . '/' . $path['filename'] . '.png';
        $cmd  = 'convert ' . escapeshellarg($file) . ' -thumbnail 16x16 -alpha on -background none -flatten ' . escapeshellarg($png);
        exec($cmd);
        
        return true;
    }
}