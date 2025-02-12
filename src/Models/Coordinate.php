<?php

namespace App\Models;
use App\Utils\UnitConverter;

class Coordinate
{
    
    private $x_coordinate;
    private $y_coordinate;

    public function __construct($x_coordinate, $y_coordinate)
    {
        $this->x_coordinate = $x_coordinate * UnitConverter::dpiToDpcm(171);
        $this->y_coordinate = $y_coordinate * UnitConverter::dpiToDpcm(171);
    }

    public function getXCoordinate(): float|int {return $this->x_coordinate;}
    
    public function getYCoordinate(): float|int {return $this->y_coordinate;}
    
    public function setXCoordinate( $x_coordinate): void {$this->x_coordinate = $x_coordinate;}

    public function setYCoordinate( $y_coordinate): void {$this->y_coordinate = $y_coordinate;}

}