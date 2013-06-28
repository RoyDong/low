<?php

namespace entity;

class Weapon
{
    const TPYE_NORMAL = 1;

    const TYPE_EXPLOSIVE = 2;

    const TYPE_LASER = 3;

    protected $type;

    protected $damage;

    public function __construct($damage, $type) 
    {
        $this->damage = $damage;
        $this->type = $type;
    }

    public function getDamage()
    {
        return $this->damage;
    }

    public function getType()
    {
        return $this->type;
    }
}