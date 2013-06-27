<?php

namespace entity;

class Center extends Structure
{
    protected $id;

    protected $cid;

    protected $speed = 10;

    public function __construct($level, $hp, $city)
    {
        $this->level = $level;
        $this->type = Struct::TYPE_FORT;
        $this->setHp($hp);
        $this->city = $city;
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