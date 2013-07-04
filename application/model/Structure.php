<?php

namespace model;

class Structure extends Base
{
    const TYPE_MINER = 1;

    const TYPE_OILWELL = 2;

    const TYPE_STORAGE = 3;

    const TYPE_TANK = 4;

    const TYPE_SUPPLY = 5;

    const TYPE_CAMP = 6;

    const TYPE_FACTORY = 7;

    const TYPE_ARIPORT = 8;

    public function __construct() 
    {
        $this->table = 'structure';
    }

    public function save(\entity\Structure $entity)
    {
        $data = [
            'cid' => $entity->getCity()->getId(),
            'level' => $entity->getLevel(),
            'type' => $entity->getType(),
            'created_at' => $entity->getCreatedAt(),
            'finish_at' => $entity->getFinishAt(),
        ];

        if($entity->getId())
            $this->update ($data, '`id`='.$entity->getId());
        else
            $entity->setId($this->insert($data));

        return $entity;
    }

    public function loadFor(\entity\City $city)
    {
        $result = $this->fetchAll(['cid' => $city->getId()]);

        foreach($result as $data)
        {
            $type = (int)$data['type'];

            switch($type)
            {
                case Structure::TYPE_MINER:
                    $entity = (new \entity\Miner)
                            ->setCity($city)
                            ->setId($data['id'])
                            ->setLevel($data['level'])
                            ->setFinishAt($data['finish_at'])
                            ->setCreatedAt($data['created_at']);

                    if($entity->getFinishAt() > 0 
                            && $entity->getFinishAt() <= time())
                    {
                        $entity->setFinishAt(0);
                        $entity->setLevel($entity->getLevel() + 1);
                        $this->save($entity);
                    }

                    $city->setMiner($entity);
                    break;
            }
        }
    }
}
