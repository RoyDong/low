<?php

namespace entity;

class Location
{
    public $x;

    public $y;

    public $mine;

    public $oil;

    public $city;

    public $abandonAt;

    public function distance(Location $target)
    {
        return sqrt(pow($target->x - $this->x, 2) + pow($target->y - $this->y, 2));
    }
}