<?php

namespace model;

class Center extends Base
{

    public function __construct() 
    {
        $this->table = 'structure';
    }

    public function save(\entity\Center $center)
    {
        $data = $center->getDbData();

        if($center->id)
            $this->update($data, '`id`='.$center->id);
        else
            $center->id = $this->insert($data);
    }
}