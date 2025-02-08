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
    
    public function getAdaptiveText(int $container_width_cm, int|float $dpi): string 
    {
        $max_length = $this->getMaxCharLength($container_width_cm, $dpi);

        return (mb_strlen($this->text) <= $max_length) ? $this->text : $this->getClippedText($max_length);
    }

    private function getMaxCharLength(int $container_width_cm, int|float $dpi): int
    {
        $cm_to_px = UnitConverter::cmToPixel(1, $dpi);
        $container_width_px = $container_width_cm * $cm_to_px;
        $text = $this->text;
        $font_size = $this->font_style->getFontSize();
        $font_filename = $this->font_style->getFontFilename();
        
        while (true) {
            // Hitung lebar teks saat ini dalam px
            $bbox = imagettfbbox($font_size, 0, $font_filename, $text);
            $text_width_px = abs($bbox[2] - $bbox[0]);
    
            // Jika teks masih muat, keluar dari loop
            if ($text_width_px <= $container_width_px) {
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

        $shortened_text = $words[0]; // Ambil kata pertama
        return $this->getNextShortenedText($words, $shortened_text, $max_length);
    }

    private function getNextShortenedText(array &$words, string $shortened_text, int $max_length): string
    {
        foreach ($words as $index => $word) {
            if ($index === 0) continue; // Lewati kata pertama, karena sudah diproses di getClippedText()
    
            $initial = mb_substr($word, 0, 1) . '.'; // Ambil inisial + titik
            $temp_text = "$shortened_text $initial"; // Gabungkan
    
            if (mb_strlen($temp_text) > $max_length) {
                break; // Jika melebihi batas, berhenti
            }
    
            $shortened_text = $temp_text; // Update hasil sementara
        }
        return $shortened_text;
    }
    
}