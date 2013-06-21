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
        $sql = 'select last_refresh_area_index la from map';
        $index = $this->pdo()->query($sql)->fetch(\PDO::FETCH_ASSOC)['la'];
        if($index < 0 || $index >= 99) $index = 0;

        $originX = (int)($index / 10);
        $originY = $index % 10;

        $resources = $this->findResourceByRange(
                $originX, $originX + Map::REFRESH_X,
                $originY, $originY + Map::REFRESH_Y);

        for($x = $originX; $x < Map::REFRESH_X; $x++)
        {
            for($y = $originY; $y < Map::REFRESH_Y; $y++)
            {

            }
        }
    }

    public function findResourceByRange($minX, $maxX, $minY, $maxY)
    {
        $sql = <<<SQL
SELECT * FROM location 
    WHERE x >= $minX AND x < $maxX AND y >= $minY AND y < $maxY
SQL;

        $result = $this->pdo()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}