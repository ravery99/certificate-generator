<?php

namespace App\Utils;

class UnitConverter {
    // Konversi Inci ke CM
    public static function inchToCm($inch) {
        return $inch * 2.54;
    }

    // Konversi CM ke Inci
    public static function cmToInch($cm) {
        return $cm / 2.54;
    }

    // Konversi Inci ke Pixel (berdasarkan DPI)
    public static function inchToPixel($inch, $dpi) {
        return $inch * $dpi;
    }

    // Konversi Pixel ke Inci (berdasarkan DPI)
    public static function pixelToInch($pixel, $dpi) {
        return $pixel / $dpi;
    }

    // Konversi CM ke Pixel (melalui Inci)
    public static function cmToPixel($cm, $dpi) {
        $inch = self::cmToInch($cm);
        return self::inchToPixel($inch, $dpi);
    }

    // Konversi Pixel ke CM (melalui Inci)
    public static function pixelToCm($pixel, $dpi) {
        $inch = self::pixelToInch($pixel, $dpi);
        return self::inchToCm($inch);
    }
}

// // Contoh Penggunaan
// echo UnitConverter::inchToCm(1) . " cm\n"; // Output: 2.54 cm
// echo UnitConverter::cmToInch(2.54) . " inch\n"; // Output: 1 inch
// echo UnitConverter::inchToPixel(1, 300) . " pixels\n"; // Output: 300 pixels
// echo UnitConverter::pixelToInch(300, 300) . " inches\n"; // Output: 1 inch
// echo UnitConverter::cmToPixel(2.54, 300) . " pixels\n"; // Output: 300 pixels
// echo UnitConverter::pixelToCm(300, 300) . " cm\n"; // Output: 2.54 cm
// 

