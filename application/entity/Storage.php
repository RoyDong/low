<?php

namespace entity;

class Storage extends Structure
{
    protected $productivity;

    protected $speed = 10;

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