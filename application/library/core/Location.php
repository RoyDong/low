<?php

namespace core;

class Location
{
    public $x;

    public $y;

    public function distance(Location $target)
    {
        return sqrt(pow($target->x - $this->x, 2) + pow($target->y - $this->y, 2));
    }
}