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

    /**
     * upgrade coefficient
     *
     * @var int
     */
    protected $uc;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLevel()
    {
        return $this->level; 
    }

    public function setLevel($level)
    {
        $this->level = (int)$level;
        return $this;
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

    public function setFinishAt($time)
    {
        $this->finishAt = (int)$time;

        return $this;
    }

    public function getFinishLevel()
    {
        return $this->finishLevel;
    }

    public function setFinishLevel($level)
    {
        $this->finishLevel = (int)$level;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(City $city)
    {
        $this->city = $city;

        return $this;
    }

    public function getUpgradeTime()
    {
        return $this->uc * pow($this->level, 4) + 10;
    }

    public function isConstructing()
    {
        return $this->finishAt > time();
    }
}