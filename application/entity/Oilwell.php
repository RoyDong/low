<?php

namespace entity;

use core\Struct;

class Oilwell extends Struct
{
    protected $speed = 10;

    protected $productivity;

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

    public function destroy() {
        ;
    }
}