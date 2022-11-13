<?php
function add_watermark($image)
{
    $image1 = $image;
    $image2 = 'images/rsz_watermark.png';
    list($width, $height) = getimagesize($image2);

    $image1 = imagecreatefromstring(file_get_contents($image1));
    $image2 = imagecreatefromstring(file_get_contents($image2));

    # Не работает полупрозрачность
    imagecolorallocate($image1, 255, 255, 255);
    imagesavealpha($image1, true);
    imagecolorallocatealpha($image2, 255, 255, 255, 127);
    imagesavealpha($image2, true);

    imagecopymerge($image1, $image2, 50, 50, 0, 0, $width, $height, 100);
    imagepng($image1, $image);
}
