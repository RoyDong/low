<?php

namespace entity;


abstract class Base
{
    public function __get($name) 
    {
        return $this->{'get'.$name}();
    }

    public function __set($name, $value)
    {
        $this->{'set'.$name}($value);
    }

    abstract function initContent($data);
}
