<?php


class UserController extends BaseController
{
	public function showAction()
    {
        $user = new \model\User;
        $this->renderJson($user->find());
    }
}