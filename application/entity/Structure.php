<?php
namespace entity;

abstract class Structure
{
    const ARMOR_NONE = 0;

    const ARMOR_LIGHT = 1;

    const ARMOR_HEAVY = 2;

    const ARMOR_FORT = 3;

    const TYPE_CENTER = 1;

    protected $level;

    protected $armor;

    protected $type;

    protected $hp;

    protected $weapon;

    protected $city;

    protected $initHp;

    protected $hpIncreament;

    protected $createdAt;

    public function fire(Struct $target) 
    {
        if($this->weapon)
            $target->shield($this->weapon->getDamage(), 
                    $this->weapon->getType());
        else
            throw new \core\Exception(1, 'Unarmed structure');
    }

    public function shield($damage, $armor)
    {
        $percent = $this->getDamageReduce($armor);
        $decrease = 1 - $this->level / 200;
        $damage = $damage * $percent * $decrease;
        $this->setHp($this->hp - $damage);
    }

    public function setHp($hp)
    {
        if($hp < 0)
        {
            $this->hp = 0;
            $this->destroy();
        }
        else
        {
            $limit = $this->getHpLimit();
            $this->hp = $hp > $limit ? $limit : $hp;
        }
    }

    public function getArmor()
    {
        return $this->armor;
    }

    public function getType()
    {
        return $this->type;
    }

    protected function getDamageReduce($damageType)
    {
        $damageSheild = $damageType * 10 + $this->armor;

        switch($damageSheild)
        {
            case 11: return 0.75;
               
            case 12: return 0.5;

            case 13: return 0.25;

            case 21: return 1.0;

            case 22: return 0.75;

            case 23: return 0.5;

            case 31: return 0.75;

            case 32: return 1;

            case 33: return 0.75;

            default : 
                throw new \core\Exception(1, 'Error attack defense type');
        }
    }

    public function getHpLimit()
    {
        return $this->initHp + $this->hpIncreament * $this->level;
    }

    public function setCreatedAt($time)
    {
        $this->createdAt = $time;

        return $this;
    }

    abstract public function destroy();
}