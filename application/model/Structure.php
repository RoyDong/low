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

    public function loadFor(\entity\City $city)
    {
        $result = $this->fetchAll(['cid' => $city->getId()]);

        foreach($result as $data)
        {
            $type = (int)$data['type'];

            switch($type)
            {
                case Structure::TYPE_MINER:
                    $entity = (new \entity\Miner($data, $city));

                    break;
            }
        }
    }
}
