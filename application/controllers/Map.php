<?php

use core\Exception;

class MapController extends BaseController
{
    public function refreshAction()
    {
        $this->Map->refreshResources();
    }

    public function bornAction()
    {
        $request = $this->getRequest();
        $x = $request->getPost('x');
        $y = $request->getPost('y');
        $user = $this->getUser();
        $map = $this->Map;
        $location = $map->find($x, $y);

        if(!$location || $location->cid)
            throw new Exception(Exception::WRONG_LOCATION, 'Wrong location');

        $city = (new entity\City)->setUser($user)->setCreatedAt(time());
        $this->City->save($city);
        $location->setCity($city);
        $map->updateNocityLocation($location);
        $this->renderJson();
    }
}
