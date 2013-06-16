<?php

namespace entity;

use core\Armor;

class Center extends Armor
{
    protected $speed = 10;

    public function __construct($level, $hp, $base, $weapon)
    {
        $this->level = $level;
        $this->type = Armor::TYPE_FORT;
        $this->setHp($hp);
        $this->base = $base;
        $this->mountWeapon($weapon);
    }

    public function explore(\core\Location $location)
    {

    }

    public function fire(Armor $target) 
    {
        $increase = 1 + $this->level / 200;
        $damage = $this->weapon->getDamage()* $increase;
        $target->damaged($damage, $this->weapon->getType());
    }

    public function destroy() 
    {
        ;
    }
}