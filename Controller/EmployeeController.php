<?php
require_once Config::MODEL_PATH . "Employee.php";

class EmployeeController
{
    static function getAll()
    {
        $employee = new Employee;
        return $employee->findAllWithArea();
    }

    static function getById($id)
    {
        $employee = new Employee;
        $oEmployee = $employee->findById($id);
        echo Message::transformResponse('OK', "¡Returned successfully!", $oEmployee[1]);
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

    static function update($id, $name, $genre, $area_id)
    {
        try {
            $employe = new Employee;
            $employe->id = $id;
            $employe->name = $name;
            $employe->genre = $genre;
            $employe->area_id = $area_id;
            $result = $employe->update();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Employee updated successfully!");
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
            $employe = new Employee;
            $employe->id = $id;
            $result = $employe->delete();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Employee deleted successfully!");
            } else {
                echo Message::transformResponse('FAIL', $result[0]);
            }
        } catch (Exception $ex) {
            echo Message::transformResponse('FAIL', "¡Something is wrong, try again!");
        }
    }
}
