<?php

namespace model;

class ObjectPool
{
    protected $models = [];

    public function get($name)
    {
        if(empty($this->models[$name]))
        {
            $class = '\model\\'.$name;
            $this->models[$name] = new $class;
        }

        return $this->models[$name];
    }
}
