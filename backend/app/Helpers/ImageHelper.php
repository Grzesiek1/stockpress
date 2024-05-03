<?php

namespace App\Helpers;

use App\Models\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageHelper
{
    public static function getSize(string $filePath): false|int
    {
        return filesize($filePath);
    }

    public static function getResolution(string $filePath): string
    {
        $imageInfo = getimagesize($filePath);

        return $imageInfo[0] . 'x' . $imageInfo[1];
    }

    public static function getExif(string $filePath): array
    {
        try {
            return exif_read_data($filePath, 'ANY_TAG', true) ?: [];
        } catch (\Exception) {
            return [];
        }
    }

    public static function getIptc(string $filePath): array
    {
        getimagesize($filePath, $info);

        return isset($info['APP13']) ? iptcparse($info['APP13']) : [];
    }
}
