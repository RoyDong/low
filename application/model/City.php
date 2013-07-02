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
        $sql = <<<SQL
select c.name, c.ctime, l.x, l.y, l.mine, l.oil, l.type, l.utime
from city c inner join location l on l.cid = c.id
where c.id = $id and c.uid = {$user->id} limit 0,1
SQL;
        $result = Base::getPdo()->query($sql)->fetch(\PDO::FETCH_ASSOC);

        if(!$result) return null;

        $location = (new \entity\Location)->setX($result['x'])
                ->setY($result['y'])
                ->setCid($id)
                ->setMine($result['mine'])
                ->setOil($result['oil'])
                ->setUtime($result['utime'])
                ->setType($result['type']);

        $city = (new \entity\City)->setId($id)
                ->setLocation($location)
                ->setName($result['name'])
                ->setCtime($result['ctime'])
                ->setUser($user);

        $result = Base::getPdo()
                ->query('select * from structure where cid = '.$id)
                ->fetchAll(\PDO::FETCH_ASSOC);

        foreach($result as $data)
            $city->loadStructure($data);

        $result = Base::getPdo()
                ->query('select * from army where cid = '.$id)
                ->fetchAll(\PDO::FETCH_ASSOC);

        foreach($result as $data)
            $city->loadArmy($data);

        return $city;
    }
}
