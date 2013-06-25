<?php

namespace entity;

class City
{
    protected $location;

    protected $user;

    protected $name;

    protected $createdAt;

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
        $this->uid = $user->id;

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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($time)
    {
        $this->createdAt = $time;

        return $this;
    }

    public function initContent($data)
    {
        $this->id = $data['id'];
        $this->uid = $data['uid'];
        $this->name = $data['name'];
        $this->createdAt = $data['created_at'];

        return $this;
    }
}
