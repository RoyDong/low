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
            $entity = (new UserEntity)->initContent($row);
            $this->cache($entity->id, $entity);

            return $entity;
        }

        return null;
    }

    public function find($id)
    {
        $entity = $this->fromCache($id);

        if($entity) return $entity;

        return $this->findOneBy(['id' => $id]);
    }

    protected function findBy($criteria, $order = null, $limit = 0, $offset = 0)
    {
        $rows = $this->fetchAll($criteria, $order, $limit, $offset);
    }

    public function save(UserEntity $entity)
    {
        $data = [
            'name' => $entity->name,
            'email' => $entity->email,
            'passwd' => $entity->passwd,
            'salt' => $entity->salt
        ];

        if($entity->id)
            $this->update($data, '`id`='.$entity->id);
        else
            $entity->id = $this->insert($data);

        $this->cache($entity->id, $entity);
    }

    public function newEntity()
    {
        return new UserEntity;
    }
}