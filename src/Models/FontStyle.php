<?php

namespace App\Models;

class FontStyle {
    private float|int $font_size;
    private string $font_filename;
    private int $font_color;

    public function __construct($font_size, $font_filename, int $font_color) {
        $this->font_size = $font_size;
        $this->font_filename = __DIR__ . "/../../assets/fonts/$font_filename";
        $this->font_color = $font_color;
    }

    public function getFontSize(): float|int 
    {
        return $this->font_size;
    }

    public function getFontFilename(): string 
    {
        return $this->font_filename;
    }
    public function getFontColor(): int
    {
        return $this->font_color;
    }
}
