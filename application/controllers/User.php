<?php

use core\Exception;

class UserController extends BaseController
{
	public function showAction($uid = 0)
    {
        $user = $this->User->find($uid);

        $this->renderJson($user);
	}

	public function signinAction()
    {
        $request = $this->getRequest();
        $email = $request->getPost('email');
        $passwd = $request->getPost('passwd');

        if(strlen($passwd) < 6) 
            throw new Exception(Exception::PASSWORD_TOO_SHORT);

        if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new Exception(Exception::EMAIL_FORMAT_ERROR);

        $user = $this->User->findOneBy(['email' => $email]);

        if(!$user->id) 
            throw new Exception(Exception::USER_NOT_FOUND);

        if(!$user->checkPasswd($passwd))
            throw new Exception(Exception::PASSWORD_ERROR);

        $this->saveSession($user);
        $this->renderJson();
	}

    public function signupAction()
    {
        $request = $this->getRequest();
        $email = $request->getPost('email');
        $passwd = $request->getPost('passwd');

        if(strlen($passwd) < 6) 
            throw new Exception(Exception::PASSWORD_TOO_SHORT);

        if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new Exception(Exception::EMAIL_FORMAT_ERROR);

        $userModel = $this->User;
        $user = $userModel->findOneBy(['email' => $email]);
        if($user) throw new Exception(Exception::EMAIL_IS_USED);

        $user = new \entity\User;
        $user->email = $email;
        $user->name = $email;
        $user->passwd = $passwd;
        $userModel->save($user);
        if(!$user->id) throw new Exception(Exception::SERVER_ERROR);

        $this->saveSession($user);
        $this->renderJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function signoutAction()
    {
        Yaf\Session::getInstance()->del('uid');
        $remember = Yaf\Registry::get('config')->get('security.remember_me');
        setcookie($remember->key, '', 0, '/');
        $this->renderJson();
    }

    private function saveSession($user, $rememberMe = true)
    {
        Yaf\Session::getInstance()->set('uid', $user->id);

        if($rememberMe)
        {
            $remember = Yaf\Registry::get('config')->get('security.remember_me');
            $time = time();
            $expire = $time + $remember->duration * 24 * 3600;
            setcookie($remember->key, $user->getAuthorizedKey($time), 
                    $expire, '/');
        }
    }
}