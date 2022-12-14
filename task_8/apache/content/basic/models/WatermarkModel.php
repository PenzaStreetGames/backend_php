<?php
namespace app\models;

class WatermarkModel {

    private static string $imageFolder = "/var/www/html/basic/web/images/";

    function addWatermark($image): void
    {
        $image1 = self::$imageFolder.$image;
        $image2 = self::$imageFolder.'watermark.png';
        list($width, $height) = getimagesize($image2);

        $image1 = imagecreatefromstring(file_get_contents($image1));
        $image2 = imagecreatefromstring(file_get_contents($image2));

        imagealphablending($image2, false);
        imagesavealpha($image2, true);
        imagefilter($image2, IMG_FILTER_COLORIZE, 0,0,0,127*0.5);

        imagecopy($image1, $image2, 50, 50, 0, 0, $width, $height);
        imagepng($image1, self::$imageFolder.$image);
    }
}