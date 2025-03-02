<?php

namespace App\Utils;
use App\Generator\FontStyle;
use App\Utils\CertificateTemplate;

class TextStyles
{
    public static FontStyle $TITLE;
    public static FontStyle $SUBTITLE;
    public static FontStyle $DESCRIPTION;

    public static function init(): void
    {
        $image = CertificateTemplate::getImage();
        self::$TITLE = new FontStyle(82, 'AmsterdamFour.ttf', imagecolorallocate($image, 3, 60, 84));
        self::$SUBTITLE = new FontStyle(36, 'LibreBaskerville-Bold.ttf', imagecolorallocate($image, 0, 191, 99));
        self::$DESCRIPTION = new FontStyle(30, 'Barlow-Light.ttf', imagecolorallocate($image, 3, 60, 84));
    }
}

// Panggil `init()` **sekali saja** saat aplikasi dimulai
// TextStyles::init();
