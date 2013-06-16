<?php


class BaseController extends Yaf\Controller_Abstract 
{
    public function get($name)
    {
        $class = $name.'Model';

        return new $class;
    }

    public function renderJson($data = null, $message = 'success', $code = 0)
    {
        $json = json_encode(
                ['message' => $message, 'code' => $code, 'data' => $data], 
                JSON_UNESCAPED_UNICODE);

        $response = $this->getResponse();
        header('Content-Type: application/json');
        $response->setBody($json);
    }
}
