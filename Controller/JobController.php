<?php
require_once Config::MODEL_PATH . "Job.php";
require_once Config::MODEL_PATH . "Employee.php";

class JobController
{
    static function getAll()
    {
        $job = new Job;
        $jobs = $job->findAll();
        if ($jobs[0]) {
            return $jobs[1];
        }
        return [];
    }

    static function getById($id)
    {
        $job = new Job;
        $oJob = $job->findByid($id);
        echo Message::transformResponse('OK', "¡Returned successfully!", $oJob[1]);
    }

    static function insert($name)
    {
        try {
            $job = new Job;
            $job->name = $name;
            $result = $job->insert();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Job inserted successfully!");
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
            $job = new Job;
            $job->id = $id;
            $job->name = $name;
            $result = $job->update();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Job updated successfully!");
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
            $job = new Job;
            $job->id = $id;
            $result = $job->delete();
            if ($result[0]) {
                echo Message::transformResponse('OK', "¡Job deleted successfully!");
            } else {
                echo Message::transformResponse('FAIL', $result[0]);
            }
        } catch (Exception $ex) {
            echo Message::transformResponse('FAIL', "¡Something is wrong, try again!");
        }
    }
}
