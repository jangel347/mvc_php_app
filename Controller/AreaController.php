<?php
require_once Config::MODEL_PATH . "Area.php";
require_once Config::MODEL_PATH . "Employee.php";

class AreaController
{
    static function getAll()
    {
        $area = new Area;
        return $area->findAllWithEmployees();
    }

    static function getById($id)
    {
        $area = new Area;
        $oArea = $area->findWithEmployees($id);
        if ($oArea[0]) {
            $oArea['employees'] = [];
            $employee = new Employee;
            $employees = $employee->getByAreaId($id);
            if ($employees[0]) {
                $oArea[1]['employees'] = $employees[1];
            }
        }
        echo Message::transformResponse('OK', "¡Returned successfully!", $oArea[1]);
    }

    static function insert($name)
    {
        try {
            $area = new Area;
            $area->name = $name;
            $result = $area->insert();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Area inserted successfully!");
            } else {
                echo Message::transformResponse('FAIL', $result[0]);
            }
        } catch (Exception $ex) {
            echo Message::transformResponse('FAIL', "¡Something is wrong, try again!");
        }
    }

    static function update($id, $name)
    {
        try {
            $area = new Area;
            $area->id = $id;
            $area->name = $name;
            $result = $area->update();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Area updated successfully!");
            } else {
                echo Message::transformResponse('FAIL', $result[0]);
            }
        } catch (Exception $ex) {
            echo Message::transformResponse('FAIL', "¡Something is wrong, try again!");
        }
    }

    static function delete($id)
    {
        try {
            $area = new Area;
            $area->id = $id;
            $result = $area->delete();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Area deleted successfully!");
            } else {
                echo Message::transformResponse('FAIL', $result[0]);
            }
        } catch (Exception $ex) {
            echo Message::transformResponse('FAIL', "¡Something is wrong, try again!");
        }
    }
}
