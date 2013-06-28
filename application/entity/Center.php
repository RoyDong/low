<?php

namespace entity;

class Center extends Structure
{
    protected $id;

    protected $cid;

    protected $damage = 100;

    public function __construct($level, $hp, $city)
    {
        $this->initHp = 100;
        $this->hpIncreament = 20;
        $this->level = $level;
        $this->type = Structure::TYPE_CENTER;
        $this->armor = Structure::ARMOR_FORT;
        $this->setHp($hp);
        $this->city = $city;
        $this->weapon = new Weapon(1000, Weapon::TYPE_LASER);
    }

    public function getName()
    {
        return 'center';
    }

    public function explore(\core\Location $location)
    {

    }

    public function destroy()
    {
        ;
    }

    public function getData()
    {
        return [
            'cid' => $this->city->id,
            'hp' => $this->hp,
            'type' => $this->type,
            'level' => $this->level
        ];
    }
}