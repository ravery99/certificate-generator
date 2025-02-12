<?php

namespace App\Utils;
use App\Models\Size;

class CertificateTemplate 
{
    private static \GdImage|bool $image = false;
    private static Size $size;

    public static function init(): void
    {
        $imagePath = __DIR__ . '/../../assets/images/template.png';
        if (!file_exists($imagePath)) {
            throw new \Exception("File template tidak ditemukan: " . $imagePath);
        }

        self::$image = imagecreatefrompng($imagePath);
        if (!self::$image) {
            throw new \Exception("Gagal memuat gambar template sertifikat.");
        }
        self::$size = new Size(2000, 1414);
    }

    public static function getImage(): \GdImage
    {
        if (!self::$image) {
            throw new \Exception("Certificate template image is not initialized. Call CertificateTemplate::init() first.");
        }
        return self::$image;
    }

    public static function getSize(): Size
    {
        if (!self::$size) {
            throw new \Exception("Certificate template size is not initialized. Call CertificateTemplate::init() first.");
        }
        return self::$size;
    }
}

// **Harus dipanggil sekali saat aplikasi dimulai**
// CertificateTemplate::init();
