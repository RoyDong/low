<?php

namespace entity;

class Center extends Structure
{
    protected $id;

    protected $cid;

    protected $damage = 100;

    public function __construct($id, $level, $hp, $city)
    {
        $this->id = $id;
        $this->initHp = 100;
        $this->hpIncreament = 20;
        $this->level = $level;
        $this->type = Structure::TYPE_CENTER;
        $this->armor = Structure::ARMOR_FORT;
        $this->setHp($hp);
        $this->city = $city;
        $this->cid = $city->id;
        $this->weapon = new Weapon(10, Weapon::TYPE_LASER);
    }

    public function getName()
    {
        return 'Command Center';
    }

    public function explore(\core\Location $location)
    {

    }

    public function destroy()
    {
        ;
    }

    public function getDbData()
    {
        return [
            'cid' => $this->city->id,
            'hp' => $this->hp,
            'type' => $this->type,
            'level' => $this->level
        ];
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'hp' => $this->hp,
            'type' => $this->type,
            'level' => $this->level,
            'weapon' => [
                'damage' => $this->weapon->getDamage(),
                'type' => $this->weapon->getType()
            ]
        ];
    }
}
