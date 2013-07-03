<?php

namespace model;

class City extends Base
{
    public function __construct() 
    {
        $this->table = 'city';
    }

    public function save(\entity\City $city)
    {
        $data = $city->getDbData();

        if($city->id)
            $this->update($data, '`id`='.$city->id);
        else
            $city->id = $this->insert($data);

        $this->setEntity($city->id, $city);
    }

    public function findOneBy($criteria)
    {
        $row = $this->fetch($criteria);

        if($row)
        {
            $entity = (new \entity\User)->initContent($row);
            $this->setEntity($entity->id, $entity);

            return $entity;
        }

        return null;
    }

    public function load($id, \entity\User $user)
    {
        $city = $this->getEntity($id);
        if($city) return $city;

        $sql = <<<SQL
select c.name, c.created_at, c.level, c.finish_at, c.finish_level, 
    l.x, l.y, l.mine, l.oil, l.type, l.updated_at
from city c inner join location l on l.cid = c.id
where c.`id` = $id and c.uid = {$user->id} limit 0,1
SQL;
        $result = Base::getPdo()->query($sql)->fetch(\PDO::FETCH_ASSOC);

        if(!$result) return null;

        $location = (new \entity\Location)
                ->setX($result['x'])
                ->setY($result['y'])
                ->setMine($result['mine'])
                ->setOil($result['oil'])
                ->setUpdatedAt($result['updated_at'])
                ->setType($result['type']);

        $city = (new \entity\City)
                ->setId($id)
                ->setName($result['name'])
                ->setLevel($result['level'])
                ->setCreatedAt($result['created_at'])
                ->setFinishAt($result['finish_at'])
                ->setFinishLevel($result['finish_level'])
                ->setLocation($location)
                ->setUser($user);

        Base::getInstance('Structure')->loadFor($city);
        //Base::getInstance('Army')->loadFor($city);
        $this->setEntity($id, $city);

        return $city;
    }
}
