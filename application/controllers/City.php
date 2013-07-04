<?php

use core\Exception;
use model\Structure;


class CityController extends BaseController
{
    protected $city;

    public function init()
    {
        if(!$this->getUser()) 
            throw new Exception(Exception::USER_NOT_SIGNIN);

        $this->city = $this->City->load(
                (int)$this->getRequest()->get('id'), $this->getUser());

        if(!$this->city)
            throw new Exception(Exception::NO_PERMISSION);
    }

    public function createAction()
    {

    }

    public function upgradeAction()
    {
        $this->city->setLevel($this->city->getLevel() + 1);
    }

    public function constructAction()
    {
        $type = $this->getRequest()->get('type');

        if(!$this->city->canConstruct($type))
            throw new Exception(Exception::NO_PERMISSION);

        switch ($type)
        {
            case Structure::TYPE_MINER:
                $miner = new \entity\Miner;
                $miner->setLevel(0)
                        ->setCreatedAt(time())
                        ->setFinishAt(time() + $miner->getUpgradeTime());

                $this->city->setMiner($miner);
                $this->Structure->save($miner);
                break;
        }

        $this->renderJson($this->city->getData());
    }

    public function showAction()
    {
        $this->renderJson($this->city->getData());
    }
}