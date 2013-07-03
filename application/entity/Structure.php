<?php

namespace entity;

abstract class Structure
{
    protected $id;

    /**
     *
     * @var City
     */
    protected $city;

    protected $level;

    protected $type;

    protected $createdAt;

    protected $finishAt;

    protected $finishLevel;

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLevel()
    {
        return $this->level; 
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($time)
    {
        $this->createdAt = (int)$time;

        return $this;
    }

    public function getFinishAt()
    {
        return $this->finishAt;
    }

    public function getFinishLevel()
    {
        return $this->finishLevel;
    }

    abstract function getUpgradeTime();
}