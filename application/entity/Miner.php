<?php

namespace entity;


class Miner extends Structure
{
    protected $productivity;

    public function __construct($data, City $city)
    {
        $this->id = (int)$data['id'];
        $this->city = $city;
        $this->createdAt = (int)$data['created_at'];
        $this->level = (int)$data['level'];
        $this->finishAt = 0;
    }

    public function getUpgradeTime()
    {
        
    }

    public function getProduction($time = 3600)
    {

    }
}