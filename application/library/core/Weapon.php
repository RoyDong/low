<?php

namespace core;

abstract class Weapon
{
    const TPYE_NORMAL = 1;

    const TYPE_EXPLOSIVE = 2;

    const TYPE_LASER = 3;

    protected $type;

    protected $damage;

    protected $owner;

    public function setOwner(Struct $owner)
    {
        $this->owner = $owner;
    }

    public function setDamage($damage)
    {
        $this->damage = $damage;
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