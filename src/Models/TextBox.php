<?php

namespace App\Models;
use App\Utils\CertificateTemplate;
use App\Utils\UnitConverter;

class TextBox 
{
    private TextDisplay $text_display;
    private Size $size;
	private Coordinate $coordinate;
    
    public function __construct($text_display, $size, $coordinate){
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
        $textbox_width = $this->size->getWidth()* UnitConverter::dpiToDpcm(171);
        $initial_coordinate = $this->getCenteredXCoordinate($textbox_width);
        // $initial_coordinate = $this->coordinate->getXCoordinate();
        $font_size = $this->text_display->getFontStyle()->getFontSize();
        $font_filename = $this->text_display->getFontStyle()->getFontFilename();
        $text = $this->text_display->getText();
        
        // Hitung lebar teks dalam px
        $bbox = imagettfbbox($font_size, 0, $font_filename, $text);
        $text_width = abs($bbox[2] - $bbox[0]);
    
        // Posisi X agar teks ada di tengah textbox
        $final_coordinate = $initial_coordinate + ($textbox_width - $text_width) / 2;
        $this->coordinate->setXCoordinate($final_coordinate);
    }

    private function setYCoordinate(): void 
    {
        $initial_coordinate = $this->coordinate->getYCoordinate();
        $textbox_height = $this->size->getHeight() * UnitConverter::dpiToDpcm(171);
        $final_coordinate = $textbox_height + $initial_coordinate;
        
        $this->coordinate->setYCoordinate($final_coordinate);
    }

    private function getCenteredXCoordinate(float|int $textbox_width): float|int
    {
        $image_width = CertificateTemplate::getSize()->getWidth();
        return ($image_width - $textbox_width) / 2;
    }
    
}