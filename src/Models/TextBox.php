<?php

namespace App\Models;
use App\Utils\CertificateTemplate;



class TextBox
{
    private TextDisplay $text_display;
    private Size $size;
    private Coordinate $coordinate;

    public function __construct($text_display, $size, $coordinate)
    {
        $this->text_display = $text_display;
        $this->size = $size;
        $this->coordinate = $coordinate;

        $this->setXCoordinate();
        $this->setYCoordinate();
    }

    public function getTextDisplay()
    {
        return $this->text_display;
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function getCoordinate(): Coordinate
    {
        return $this->coordinate;
    }

    private function setXCoordinate(): void
    {
        $textbox_width = $this->size->getWidth();
        $font_size = $this->text_display->getFontStyle()->getFontSize();
        $font_filename = $this->text_display->getFontStyle()->getFontFilename();

        // Ambil teks singkatan jika terlalu panjang
        $text = $this->text_display->getAdaptiveText($textbox_width, 171);

        // 🔥 HITUNG ULANG bounding box untuk teks yang sudah disingkat
        $bbox = imagettfbbox($font_size, 0, $font_filename, $text);

        // Ambil lebar teks baru (pastikan nilai absolut)
        $text_width = abs($bbox[2] - $bbox[0]);

        // Pusatkan teks berdasarkan lebar barunya
        $textbox_x_center = $this->coordinate->getXCoordinate() + ($textbox_width / 2);
        $final_x = $textbox_x_center - ($text_width / 2);

        // 🔥 Geser sedikit ke kiri
        $final_x -= 5; // Coba mulai dari -5, sesuaikan kalau masih kurang

        // Debugging
        error_log("Teks asli/singkat: " . $text);
        error_log("Textbox Width: " . $textbox_width);
        error_log("Text Width: " . $text_width);
        error_log("Final X setelah koreksi: " . $final_x);

        // Set koordinat supaya teks tetap di tengah
        $this->coordinate->setXCoordinate($final_x);
    }




    private function setYCoordinate(): void
    {
        $initial_coordinate = $this->coordinate->getYCoordinate();
        $textbox_height = $this->size->getHeight();
        $final_coordinate = $textbox_height + $initial_coordinate;

        $this->coordinate->setYCoordinate($final_coordinate);
    }

    private function getCenteredXCoordinate(float|int $textbox_width): float|int
    {
        $image_width = CertificateTemplate::getSize()->getWidth();
        return ($image_width - $textbox_width) / 2;
    }

}