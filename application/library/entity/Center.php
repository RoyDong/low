<?php

namespace entity;

use core\Struct;

class Center extends Struct
{
    protected $speed = 10;

    public function __construct($level, $hp, $base, $weapon)
    {
        $this->level = $level;
        $this->type = Struct::TYPE_FORT;
        $this->setHp($hp);
        $this->base = $base;
        $this->weapon = $weapon;
    }

    public function explore(\core\Location $location)
    {

    }

    public function destroy()
    {
        ;
    }
}