<?php

namespace App\Generator;
use App\Utils\UnitConverter;

class Size 
{
    private float|int $width;
    private float|int $height;
   
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float|int {return $this->width;}

    public function getHeight(): float|int {return $this->height;}

}