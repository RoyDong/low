<?php

namespace model;

class City extends Base
{
    public function __construct() 
    {
        $this->table = 'city';
    }
}