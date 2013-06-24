<?php

namespace model;

class Map extends Base
{
    const MAX_X = 1000;

    const MAX_Y = 1000;

    const REFRESH_X = 100;

    const REFRESH_Y = 100;

    const TYPE_LAND = 1;

    const TYPE_SEA = 2;

    const MINE_INIT_MIN = 1000;
    const MINE_INIT_MAX = 10000;

    const OIL_INIT_MIN = 500;
    const OIL_INIT_MAX = 5000;

    public function __construct()
    {
        $this->table = 'location';
    }

    public function createBirthLocation($x, $y, $cid)
    {
        $location = $this->fetch(['x' => $x, 'y' => $y]);
        if($location['city_id']) 
            throw new \core\Exception(1, 'Location is used');

        $location['mine'] = 5000;
        $location['oil'] = 5000;
        $location['city_id'] = $cid;
        $location['refresh_at'] = time();
        $this->update($location, 
            "`x`={$location['x']} AND `y`={$location['y']}");

        return $location;
    }

    public function refreshResources()
    {
        $sql = 'select last_refresh_x x, last_refresh_y y from map';
        $start = $this->pdo()->query($sql)->fetch(\PDO::FETCH_ASSOC);
        if(!$start)$start = ['x' => 0, 'y' => 0];
        $endX = $start['x'] + Map::REFRESH_X;
        $endY = $start['y'] + Map::REFRESH_Y;
        if($endX > Map::MAX_X) $endX = Map::MAX_X;
        if($endY > Map::MAX_Y) $endY = Map::MAX_Y;
        $locations = $this->getNocityLocations(
                $start['x'], $endX, $start['y'], $endY);
        $range = 100;
        $possibility = 5;
        $time = time();
        $sql = [];
        $missCount = 0;

        foreach($locations as $location)
        {
            if(mt_rand(1, $range) > $possibility)
            {
                $missCount++;
                $possibility += (int)($missCount / 20);
                $data = [
                    'mine' => 0,
                    'oil' => 0,
                    'refresh_at' => $time
                ];
            }
            else
            {
                $possibility = 5;
                $missCount = 0;
                $data = [
                    'mine' => mt_rand(Map::MINE_INIT_MIN, Map::MINE_INIT_MAX),
                    'oil' => mt_rand(Map::OIL_INIT_MIN, Map::OIL_INIT_MAX),
                    'refresh_at' => $time
                ];
            }

            $where = "`x`={$location['x']} AND `y`={$location['y']}";
            $sql[] = $this->getUpdateSql($data, $where).';';
        }

        $this->pdo()->exec(implode('', $sql));
    }

    protected function getNocityLocations($minX, $maxX, $minY, $maxY)
    {
        $sql = 'SELECT * FROM location WHERE `type` = '.Map::TYPE_LAND
            ." AND x >= $minX AND x < $maxX AND y >= $minY AND y < $maxY"
            .' AND city_id = 0';

        return $this->pdo()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}
