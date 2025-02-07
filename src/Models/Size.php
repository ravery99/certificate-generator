<?php

namespace App\Models;

class Size 
{
    private $width;
    private $height;
   
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float|int {return $this->width;}

    public function getHeight(): float|int {return $this->height;}

}