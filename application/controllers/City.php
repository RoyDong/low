<?php


class CityController extends BaseController
{
	public function showAction($id)
    {
        $this->renderJson($this->User->find(1));
    }
}