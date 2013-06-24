<?php

$fp = fopen('/tmp/map.sql', 'w');


for($x = 0; $x < 1000; $x++)
{
    $sql = 'insert into location (x,y)values';
    fwrite($fp, $sql);

    for($y = 0; $y < 1000; $y++)
    {
        if($y == 999)
            $sql = "($x,$y);\n";
        else
            $sql = "($x,$y),\n";

        fwrite($fp, $sql);
    }
}

fclose($fp);
