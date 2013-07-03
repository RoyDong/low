<?php

namespace entity;

use model\Structure as StructModel;

class City extends Base
{
    protected $id;

    protected $name = '';

    protected $level = 0;

    protected $uid = 0;

    protected $user;

    protected $location;

    protected $army;

    protected $production = [];

    protected $oilwells = [];

    protected $miners = [];

    protected $storages = [];

    protected $tanks = [];

    protected $camp;

    protected $factory;

    protected $airport;

    protected $createdAt;

    protected $finishAt;

    protected $finishLevel;

    protected $constructingLineCount = 0;

    public function setId($id)
    {
        $this->id = (int)$id;

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
        $location->setCity($this);

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
        $this->createdAt= (int)$time;

        return $this;
    }

    public function setFinishAt($time)
    {
        $this->finishAt = (int)$time;

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

    public function setFinishLevel($level)
    {
        $this->finishLevel = (int)$level;

        return $this;
    }

    public function initContent($data)
    {
        $this->id = (int)$data['id'];
        $this->uid = (int)$data['uid'];
        $this->name = $data['name'];
        $this->createdAt = (int)$data['created_at'];
        $this->finishAt = (int)$data['finish_at'];
        $this->finishLevel = (int)$data['finish_level'];

        return $this;
    }

    public function getDbData()
    {
        return [
            'uid' => $this->uid,
            'name' => $this->name,
            'created_at' => $this->createdAt,
            'finish_at' => $this->finishAt,
            'finish_level' => $this->finishLevel
        ];
    }

    public function getData()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'level' => $this->level,
            'created_at' => $this->createdAt,
            'finish_at' => $this->finishAt,
            'finish_level' => $this->finishLevel,
            'location' => $this->location->getData()
        ];

        if($this->user)
            $data['user'] = $this->user->getData();

        return $data;
    }

    public function getMaxConstructLineCount()
    {
        return (int)($this->level / 5) + 1;
    }

    public function getConstructingLineCount()
    {
        return $this->constructingLineCount;
    }

    public function canConstruct($type)
    {
        switch ($type)
        {
            case StructModel::TYPE_MINER:
        }
    }
}
