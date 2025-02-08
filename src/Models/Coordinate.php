<?php

namespace App\Models;

class Coordinate
{
    
    private $x_coordinate;
    private $y_coordinate;

    public function __construct($x_coordinate, $y_coordinate)
    {
        $this->x_coordinate = $x_coordinate;
        $this->y_coordinate = $y_coordinate;
    }

    public function getXCoordinate(): float|int {return $this->x_coordinate;}
    
    public function getYCoordinate(): float|int {return $this->y_coordinate;}
    
    public function setXCoordinate( $x_coordinate): void {$this->x_coordinate = $x_coordinate;}

    public function setYCoordinate( $y_coordinate): void {$this->y_coordinate = $y_coordinate;}

}