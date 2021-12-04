<?php
include "../Model/Area.php";

class AreaController
{
    static function getAll()
    {
        $area = new Area;
        $oArea = $area->findAll();
        if ($oArea[0]) {
            return $oArea[1];
        } else {
            return [];
        }
    }

    public function insert()
    {
        // $employe = new Area;
        // $employe->name = 'Jeison Angelito';
        // $employe->genre = 'm';
        // $employe->area_id = 3;
        // echo json_encode($employe->insert());
    }
}
