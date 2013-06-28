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
        $data = $city->getData();

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
        $sql = 'select c.name,s* from city c left join structure s s.cid = c.id'
                ."where c.id = $id and c.uid = {$user->id}";

        $result = Base::getPdo()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}