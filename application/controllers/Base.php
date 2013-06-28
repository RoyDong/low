<?php


class BaseController extends Yaf\Controller_Abstract 
{
    protected $yafAutoRender = false;

    public function __get($name)
    {
        return \model\Base::getInstance($name);
    }

    public function getUser()
    {
        $uid = Yaf\Session::getInstance()->get('uid');
        if($uid) return $this->User->find($uid);

        return null;
    }

    public function renderJson($data = null, $message = 'done', $code = 0)
    {
        $json = json_encode(
                ['message' => $message, 'code' => $code, 'data' => $data], 
                JSON_UNESCAPED_UNICODE);

        header('Content-Type: application/json');
        $this->getResponse()->setBody($json);
    }
}