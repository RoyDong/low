<?php

namespace entity;

use model\Structure as StructModel;

class City extends Base
{
    protected $id;

    protected $name = '';

    protected $level = 0;

    protected $user;

    /**
     *
     * @var Location
     */
    protected $location;

    protected $army;

    protected $production = [];

    protected $oilwells = [];

    protected $miners = [];

    protected $mine;

    protected $oil;

    protected $storages = [];

    protected $tanks = [];

    protected $camp;

    protected $factory;

    protected $airport;

    protected $createdAt;

    protected $updatedAt;

    protected $finishAt;

    protected $finishLevel;

    protected $constructingLineCount = 0;

    protected $minerLimit;

    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @return Location
     */
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
            'uid' => $this->user->getId(),
            'name' => $this->name,
            'mine' => $this->mine,
            'oil' => $this->oil,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'finish_at' => $this->finishAt,
            'finish_level' => $this->finishLevel
        ];
    }

    public function getData()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'mine' => $this->mine,
            'oil' => $this->oil,
            'level' => $this->level,
            'created_at' => $this->createdAt,
            'finish_at' => $this->finishAt,
            'location' => $this->location->getData()
        ];

        if($this->user)
            $data['user'] = $this->user->getData();

        if($this->miners)
        {
            foreach($this->miners as $miner)
                $miners[] = $miner->getData();

            $data['miners'] = $miners;
        }

        return $data;
    }

    public function getConstructLineLimit()
    {
        return (int)($this->level / 5) + 1;
    }

    public function getConstructingLineCount()
    {
        return $this->constructingLineCount;
    }

    public function canConstruct($type)
    {
        if($this->getConstructLineLimit() <= $this->getConstructingLineCount())
            return false;

        switch($type)
        {
            case StructModel::TYPE_MINER:
                return count($this->miners) < $this->getMinerLimit();
               
        }
    }

    public function getMinerLimit()
    {
        return (int)($this->level / 5) + 1;
    }

    public function setMiner(Miner $miner)
    {
        if(empty($this->miners[$miner->getId()]))
        {
            $this->miners[$miner->getId()] = $miner;
            $miner->setCity($this);

            if($miner->isConstructing())
                $this->constructingLineCount++;
        }
    }

    public function setMine($mine)
    {
        $this->mine = (int)$mine;

        return $this;
    }

    public function setOil($oil)
    {
        $this->oil = (int)$oil;

        return $this;
    }

    public function setUpdatedAt($time)
    {
        $this->updatedAt = (int)$time;

        return $this;
    }

    public function updateResource()
    {
        $time = time() - $this->updatedAt;
        $production = 0;

        foreach($this->miners as $miner)
        {
            $production += $miner->getProduction($time);
        }

        $mine = $this->location->getMine();
        if($mine < $production) $production = $mine;
        $this->mine += $production;
        $this->location->setMine($mine - $production);
        $this->updatedAt = time();
    }
}
