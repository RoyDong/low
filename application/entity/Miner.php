<?php

namespace entity;


class Miner extends Structure
{
    protected $productivity;

    public function __construct() 
    {
        $this->type = \model\Structure::TYPE_MINER;
    }

    public function getProduction($time = 3600)
    {
        return $this->level * $time;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'level' => $this->level,
            'production' => $this->getProduction(1),
            'created_at' => $this->createdAt,
            'finish_at' => $this->finishAt,
        ];
    }
}