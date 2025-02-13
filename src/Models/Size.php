<?php

namespace App\Models;
use App\Utils\UnitConverter;

class Size 
{
    private $width;
    private $height;
   
    public function __construct($width, $height)
    {
        $this->width = $width * UnitConverter::dpiToDpcm(171);
        $this->height = $height * UnitConverter::dpiToDpcm(171);
    }

    public function getWidth(): float|int {return $this->width;}

    public function getHeight(): float|int {return $this->height;}

}