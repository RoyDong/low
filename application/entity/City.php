<?php

namespace entity;

class City extends Base
{
    protected $id;

    protected $location;

    protected $user;

    protected $name = '';

    protected $uid = 0;

    protected $createdAt = 0;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

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

    public function getData()
    {
        return [
            'uid' => $this->uid,
            'name' => $this->name,
            'created_at' => $this->createdAt
        ];
    }
}
