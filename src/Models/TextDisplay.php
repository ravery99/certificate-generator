<?php

namespace App\Models;
use App\Utils\UnitConverter;



class TextDisplay
{
    private string $text;
    private FontStyle $font_style;

    public function __construct($text, $font_style)
    {
        $this->text = $text;
        $this->font_style = $font_style;
    }

    public function getFontStyle(): FontStyle
    {
        return $this->font_style;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getAdaptiveText(int $container_width, int|float $dpi): string
    {
        $max_length = $this->getMaxCharLength($container_width, $dpi);
        return (mb_strlen($this->text) <= $max_length) ? $this->text : $this->getClippedText($max_length);
    }

    private function getMaxCharLength(int $container_width, int|float $dpi): int
    {
        $text = $this->text;
        $font_size = $this->font_style->getFontSize();
        $font_filename = $this->font_style->getFontFilename();

        while (true) {
            // Hitung lebar teks saat ini dalam px
            $bbox = imagettfbbox($font_size, 0, $font_filename, $text);
            $text_width_px = abs($bbox[2] - $bbox[0]);

            // Jika teks masih muat, keluar dari loop
            if ($text_width_px <= $container_width) {
                break;
            }

            // Jika teks kepanjangan, potong satu karakter dari belakang
            $text = mb_substr($text, 0, -1);
        }

        return mb_strlen($text);
    }


    private function getClippedText(int $max_length): string
    {
        $words = explode(' ', $this->text);
        if (empty($words)) {
            return ''; // Pastikan tidak error jika teks kosong
        }
        $shortened_text = implode(' ', array_slice($words, 0, min(3, count($words))));
        return $this->getNextShortenedText($words, $shortened_text, $max_length);
    }

    private function getNextShortenedText(array $words, string $shortened_text, int $max_length): string
    {
        for ($i = 3; $i < count($words); $i++) { // Mulai dari kata ke-4
            $initial = mb_substr($words[$i], 0, 1) . '.'; // Ambil inisial + titik
            $temp_text = "$shortened_text $initial"; // Gabungkan

            if (mb_strlen($temp_text) > $max_length) {
                break; // Jika melebihi batas, berhenti
            }

            $shortened_text = $temp_text; // Update hasil sementara
        }
        return $shortened_text;
    }


}