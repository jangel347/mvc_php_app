<?php
include "../Model/Area.php";

class AreaController
{
    public function getAll()
    {
        $area = new Area;
        return $area->findAll();
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
