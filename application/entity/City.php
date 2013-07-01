<?php

namespace entity;

use core\Exception;

class City extends Base
{
    protected $id;

    protected $name = '';

    protected $uid = 0;

    protected $user;

    protected $location;

    protected $ctime;

    public function loadStructure($data)
    {
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

    public function getCtime()
    {
        return $this->ctime;
    }

    public function setCtime($time)
    {
        $this->ctime= $time;

        return $this;
    }

    public function initContent($data)
    {
        $this->id = (int)$data['id'];
        $this->uid = (int)$data['uid'];
        $this->name = $data['name'];
        $this->ctime = (int)$data['ctime'];

        return $this;
    }

    public function getDbData()
    {
        return [
            'uid' => $this->uid,
            'name' => $this->name,
            'ctime' => $this->ctime
        ];
    }

    public function getData()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->createdAt,
            'location' => $this->location->getData()
        ];

        if($this->user)
            $data['user'] = $this->user->getData();

        return $data;
    }
}
