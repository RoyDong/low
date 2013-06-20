<?php

namespace model;

class Map extends Base
{
    public function __construct() 
    {
        $this->table = 'map';
    }

    public function createBirthLocation()
    {
        $location = new \entity\Location;
        $location->x = 1;
        $location->y = 1;
        $location->mine = 2000;
        $location->oil = 1000;
        $location->rebornTime = 0;

        return $location;
    }
}