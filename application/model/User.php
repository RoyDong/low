<?php

namespace model;

class User extends Base
{
    public function __construct() 
    {
        $this->table = 'user';
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

    public function find($id)
    {
        $entity = $this->getEntity($id);

        if($entity) return $entity;

        return $this->findOneBy(['id' => $id]);
    }

    public function save(\user\User $user)
    {
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'passwd' => $user->passwd,
            'salt' => $user->salt
        ];

        if($user->id)
            $this->update($data, '`id`='.$user->id);
        else
            $user->id = $this->insert($data);

        $this->setEntity($user->id, $user);
    }
}