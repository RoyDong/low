<?php

namespace model;

class Map extends Base
{
    const MAX_X = 1000;

    const MAX_Y = 1000;

    const REFRESH_X = 100;

    const REFRESH_Y = 100;

    public function __construct()
    {
        $this->table = 'location';
    }

    public function createBirthLocation()
    {
        $location = new \entity\Location;
        $location->x = 1;
        $location->y = 1;
        $location->mine = 2000;
        $location->oil = 1000;

        return $location;
    }

    public function refresh()
    {
        
    }

    public function getLastRefreshArea()
    {
        $sql = 'select last_refresh_x x, last_refresh_y y from map';
        $start = $this->pdo()->query($sql)->fetch(\PDO::FETCH_ASSOC);
        $endX = $start['x'] + Map::REFRESH_X;
        $endY = $start['y'] + Map::REFRESH_Y;
        if($endX > Map::MAX_X) $endX = Map::MAX_X;
        if($endY > Map::MAX_Y) $endY = Map::MAX_Y;

        $resources = $this->findResourceByRange(
                $start['x'], $endX, $start['y'], $endY);


        for($x = $start['x']; $x < $endX; $x++)
        {
            for($y = $start['y']; $y < $endY; $y++)
            {

            }
        }
    }

    public function findResourceByRange($minX, $maxX, $minY, $maxY)
    {
        $sql = 'SELECT * FROM location WHERE '
                ."x >= $minX AND x < $maxX AND y >= $minY AND y < $maxY";

        return $this->pdo()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}