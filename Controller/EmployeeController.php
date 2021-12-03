<?php
include "../Model/Employee.php";

class EmployeeController
{
    public function getAll()
    {
        $employee = new Employee;
        return $employee->findAllWithArea();
    }

    public function insert()
    {
        $employe = new Employee;
        $employe->name = 'Jeison Angelito';
        $employe->genre = 'm';
        $employe->area_id = 3;
        echo json_encode($employe->insert());
    }
}
