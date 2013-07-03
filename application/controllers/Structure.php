<?php

use core\Exception;

class StructureController extends BaseController
{

    public function init()
    {
        if(!$this->getUser()) throw new Exception(Exception::USER_NOT_SIGNIN);
    }


    public function createAction()
    {
        $type = $this->getRequest()->get('type');

        $this->renderJson($type);
    }

    public function upgradeAction()
    {
        $type = $this->getRequest()->get('type');

        $this->renderJson($type);
    }
}