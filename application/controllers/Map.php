<?php

use core\Exception;

class MapController extends BaseController
{
    public function refreshAction()
    {
        $this->Map->refreshResources();
    }

    public function settleDownAction()
    {
        $request = $this->getRequest();
        $x = $request->getPost('x');
        $y = $request->getPost('y');
        $user = $this->getUser();
        $mapModel = $this->Map;
        $cityModel = $this->City;
        $location = $mapModel->getSettleDownLocation($x, $y);

        if(!$location)
            throw new Exception(Exception::ERROR_LOCATION, 'Error location');

        if($cityModel->countByUser($user->id))
            throw new Exception (Exception::NOT_NEW_PLAYER, 'Not new player');

        $city = (new entity\City)->setUser($user)->setCreatedAt(time());
        $cityModel->save($city);
        $location->setCity($city)
                ->setMine(5000)
                ->setOil(5000)
                ->setRefreshAt(time());

        $mapModel->updateNocityLocation($location);

        $this->renderJson();
    }
}
