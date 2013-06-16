<?php

namespace entity;

use core\Armor;

class Supply extends Armor
{

    public function __construct($base, $level, $hp)
    {
        $this->base = $base;
        $this->level = $level;
        $this->setHp($hp);
    }

    public function fire($target) 
    {
        throw new \core\Exception(1, 'no weapon');
    }

    public function getSize()
    {
        return 8 + $this->level * 4;
    }

    public function destroy() {
        ;
    }
}