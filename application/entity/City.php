<?php

namespace entity;

class City extends Base
{
    protected $id;

    protected $name = '';

    protected $uid = 0;

    protected $createdAt = 0;

    protected $user;

    protected $location;

    protected $center;

    public function loadStructure($data)
    {
        switch ($data['type'])
        {
            case Structure::TYPE_CENTER :
                $center = new Center($data['level'], $data['hp'], $this);
                $this->setCenter($center);
                return $center;

            default : 
                throw new \core\Exception(\core\Exception::ERROR_STRUCTURE_TYPE);
        }
    }

    public function setCenter($center)
    {
        $this->center = $center;

        return $this;
    }

    public function getCenter()
    {
        return $this->center;
    }

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
