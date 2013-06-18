<?php

namespace entity;

class City
{
    protected $location;

    protected $user;

    protected $name;

    protected $createTime;

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation(Location $location)
    {
        $this->location = $location;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getCreateTime()
    {
        return $this->createTime;
    }

    public function setCreateTime($time)
    {
        $this->createTime = $time;

        return $this;
    }
}