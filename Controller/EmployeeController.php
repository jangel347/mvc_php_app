<?php
require_once Config::MODEL_PATH . "Employee.php";

class EmployeeController
{
    static function getAll()
    {
        $employee = new Employee;
        return $employee->findAllWithArea();
    }

    static function insert($name, $genre, $area_id)
    {
        try {
            $employe = new Employee;
            $employe->name = $name;
            $employe->genre = $genre;
            $employe->area_id = $area_id;
            $result = $employe->insert();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Employee inserted successfully!");
            } else {
                echo Message::transformResponse('FAIL', $result[0]);
            }
        } catch (Exception $ex) {
            echo Message::transformResponse('FAIL', "¡Something is wrong, try again!");
        }
    }
}
