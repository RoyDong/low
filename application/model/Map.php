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

    public function find($x, $y)
    {
        $key = $x.','.$y;
        $location = $this->getEntity($key);

        if(!$location)
        {
            $data = $this->fetch(['x' => $x, 'y' => $y]);
            $location = (new \entity\Location)->initContent($data);
            $this->setEntity($key, $location);
        }

        return $location;
    }

    public function save(Location $location)
    {
        $data = $location->getData();

        return $this->update($data, "`x`={$data['x']} AND `y`={$data['y']}");
    }

    public function updateNocityLocation(\entity\Location $location)
    {
        $data = [
            'cid' => $location->cid,
            'mine' => $location->mine,
            'oil' => $location->oil,
            'refresh_at' => $location->refreshAt
        ];
        $where = "`x`={$location->x} AND `y`={$location->y}"
                .' AND `cid`=0 AND `type`='.Map::TYPE_LAND;

        return $this->update($data, $where);
    }

    public function getSettleDownLocation($x, $y)
    {
        $sql = "select * from location where `x`=$x and `y`=$y"
                .' and mine=0 and oil=0 and cid=0 and `type`='.Map::TYPE_LAND
                .' limit 0,1';

        $data = Base::getPdo()->query($sql)->fetch(\PDO::FETCH_ASSOC);

        if($data)
            return (new \entity\Location)->initContent($data);

        return null;
    }

    public function refreshResources()
    {
        $sql = 'select last_refresh_x x, last_refresh_y y from map';
        $start = Base::getPdo()->query($sql)->fetch(\PDO::FETCH_ASSOC);
        if(!$start)$start = ['x' => 0, 'y' => 0];
        $endX = $start['x'] + Map::REFRESH_X;
        $endY = $start['y'] + Map::REFRESH_Y;
        if($endX > Map::MAX_X) $endX = Map::MAX_X;
        if($endY > Map::MAX_Y) $endY = Map::MAX_Y;
        $locations = $this->getNocityLocations(
                $start['x'], $endX, $start['y'], $endY);

        $possibility = 5;
        $time = time();
        $missCount = 0;

        foreach($locations as $location)
        {
            if(mt_rand(1, 100) > $possibility)
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
            $this->update($data, $where);
        }
    }

    protected function getNocityLocations($minX, $maxX, $minY, $maxY)
    {
        $sql = 'SELECT * FROM location WHERE `type` = '.Map::TYPE_LAND
            ." AND x >= $minX AND x < $maxX AND y >= $minY AND y < $maxY"
            .' AND cid = 0';

        return Base::getPdo()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}
