<?php

namespace entity;

class Location
{
    public $x;

    public $y;

    public $mine;

    public $oil;

    public $city;

    public $type;

    public $abandonAt;

    public function distance(Location $location)
    {
        return sqrt(pow($location->x - $this->x, 2) + 
            pow($location->y - $this->y, 2));
    }
}
