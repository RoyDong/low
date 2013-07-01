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

        $city = (new entity\City)->setUser($user)
                ->setName($name)
                ->setCreatedAt(time());
        $cityModel->save($city);

        $location->setCity($city)
                ->setMine(5000)
                ->setOil(5000)
                ->setRefreshAt(time());
        $mapModel->updateNocityLocation($location);

        $center = (new entity\Center(1, 0, $city))->setCreatedAt(time());
        $center->setHp($center->getHpLimit());
        $this->Center->insert($center->getDbData(), true);

        $this->renderJson();
    }
}
