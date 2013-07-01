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

        $location = (new \entity\Location)->setX((int)$result['x'])
                ->setY((int)$result['y'])
                ->setCid((int)$id)
                ->setMine((int)$result['mine'])
                ->setOil((int)$result['oil'])
                ->setRefreshAt((int)$result['utime'])
                ->setType((int)$result['type']);

        $city = (new \entity\City)->setId((int)$id)
                ->setLocation($location)
                ->setName($result['name'])
                ->setCreatedAt((int)$result['created_at'])
                ->setUser($user);

        $time = time();
        $production = [];
        $completed = [];
        $result = Base::getPdo()
                ->query('select * from production where cid = '.$id)
                ->fetchAll(\PDO::FETCH_ASSOC);

        foreach($result as $product)
        {
            if($product['time'] >= $time)
            {
                $completed[$product['tid']] = $product;
                Base::buffer('delete * from `production` where id='
                        .$product['id']);
            }
            else
                $city->addProduction($product);
        }

        //$sql = 'select * from army where cid = '.$id;

        $result = Base::getPdo()
                ->query('select * from structure where cid = '.$id)
                ->fetchAll(\PDO::FETCH_ASSOC);

        foreach($result as $data)
        {
            $id = $data['id'];
            if(isset($completed[$id])) 
                $data['level'] = $completed[$id]['value'];
            $city->loadStructure($data);
        }

        return $city;
    }
}
