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

    protected $refreshAt;

    public function getX()
    {
        return $this->x;
    }

    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    public function getMine()
    {
        return $this->mine;
    }

    public function setMien($mine)
    {
        $this->mine = $mine;

        return $this;
    }

    public function getOil()
    {
        return $this->oil;
    }

    public function setOil($oil)
    {
        $this->oil = $oil;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

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

    public function getCityId()
    {
        return $this->cid;
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
        $this->x = $data['x'];
        $this->y = $data['y'];
        $this->mine = $data['mine'];
        $this->oil = $data['oil'];
        $this->cid = $data['cid'];
        $this->type = $data['type'];
        $this->refreshAt = $data['refresh_at'];

        return $this;
    }
}
