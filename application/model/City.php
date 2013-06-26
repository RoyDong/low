<?php

namespace model;

class City extends Base
{
    public function __construct() 
    {
        $this->table = 'city';
    }

    public function countByUser($uid)
    {
        return $this->count('`uid`='.$uid);
    }

    public function save(\entity\City $city)
    {
        $data = $city->getData();

        if($city->id)
            $this->update ($data, '`id`='.$city->id);
        else
            $city->id = $this->insert($data);

        $this->setEntity($city->id, $city);
    }

    public function loadCity()
    {

    }
}