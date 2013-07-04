<?php

use core\Exception;

class MapController extends BaseController
{
    public function refreshAction()
    {
        $this->Map->refreshResources();
    }

    public function settledownAction()
    {
        $request = $this->getRequest();
        $x = $request->get('x');
        $y = $request->get('y');
        $name = $request->get('name');
        $user = $this->getUser();
        $mapModel = $this->Map;
        $cityModel = $this->City;
        $location = $mapModel->getSettleDownLocation($x, $y);

        if(!$location)
            throw new Exception(Exception::ERROR_LOCATION, 'Error location');

        if($cityModel->count('`uid`='.$user->id))
            throw new Exception(Exception::NOT_NEW_PLAYER, 'Not new player');

        $time = time();
        $city = (new entity\City)
                ->setUser($user)
                ->setName($name)
                ->setLevel(1)
                ->setUpdatedAt($time)
                ->setCreatedAt($time);

        $cityModel->save($city);
        $city->setLocation($location);
        $location->setMine(5000)->setOil(5000)->setUpdatedAt($time);
        $mapModel->updateNocityLocation($location);
        $this->renderJson($city->getData());
    }

    public function curveAction()
    {
        $data = [];
        $s = 0;

        for($i = 1; $i < 20; $i++)
        {
            $s =   pow($i, 4) + 10;
            $s1 = 2 * pow($i, 4) + 10;

            $data[] = date('d H:i:s', $s);
            $data1[] = date('d H:i:s', $s1);
        }

        echo '<pre>';
        print_r($data);
        print_r($data1);

        $this->yafAutoRender = true;
    }
}
