<?php

use core\Exception;

class CityController extends BaseController
{

    public function init()
    {
        if(!$this->getUser()) throw new Exception(Exception::USER_NOT_SIGNIN);
    }

	public function showAction($id)
    {
        $user = $this->getUser();
        $city = $this->City->load($id, $user);
        if(!$city) throw new Exception(Exception::NO_PERMISSION);

        $this->renderJson($city->getData());
    }
}