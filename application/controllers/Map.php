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

        $location = $this->Map->find($x, $y);
    }
}
