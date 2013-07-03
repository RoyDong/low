<?php

namespace entity;

class Location extends Base
{
    protected $x;

    protected $y;

    protected $mine;

    protected $oil;

    protected $city;

    protected $cid;

    protected $type;

    protected $updatedAt;

    public function getX()
    {
        return $this->x;
    }

    public function setX($x)
    {
        $this->x = (int)$x;

        return $this;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY($y)
    {
        $this->y = (int)$y;

        return $this;
    }

    public function getMine()
    {
        return $this->mine;
    }

    public function setMine($mine)
    {
        $this->mine = (int)$mine;

        return $this;
    }

    public function getOil()
    {
        return $this->oil;
    }

    public function setOil($oil)
    {
        $this->oil = (int)$oil;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = (int)$type;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
        $this->cid = $city->id;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($time)
    {
        $this->updatedAt = (int)$time;

        return $this;
    }

    public function distance(Location $location)
    {
        return sqrt(pow($location->x - $this->x, 2) + 
            pow($location->y - $this->y, 2));
    }

    public function getKey()
    {
        return $this->x.','.$this->y;
    }

    public function initContent($data)
    {
        $this->x = (int)$data['x'];
        $this->y = (int)$data['y'];
        $this->mine = (int)$data['mine'];
        $this->oil = (int)$data['oil'];
        $this->cid = (int)$data['cid'];
        $this->type = (int)$data['type'];
        $this->updatedAt = (int)$data['updated_at'];

        return $this;
    }

    public function getData()
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
            'mine' => $this->mine,
            'oil' => $this->oil,
            'type' => $this->type
        ];
    }
}