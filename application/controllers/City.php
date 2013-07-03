<?php

use core\Exception;

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

    }

    public function constructAction()
    {
        $type = $this->getRequest()->get('type');

        if($this->city->canConstruct($type))
        {

        }
    }

    public function showAction()
    {
        $this->renderJson($this->city->getData());
    }
}