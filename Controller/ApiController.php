<?php
require_once "config.php";
if (isset($_POST)) {
    if (isset($_POST['function'])) {
        switch ($_POST['function']) {
            case 'insert_employee':
                require_once Config::CONTROLLER_PATH . 'EmployeeController.php';
                EmployeeController::insert($_POST['name'], $_POST['genre'], $_POST['area_id'], $_POST['jobs']);
                break;
            case 'update_employee':
                require_once Config::CONTROLLER_PATH . 'EmployeeController.php';
                EmployeeController::update($_POST['id'], $_POST['name'], $_POST['genre'], $_POST['area_id'], $_POST['jobs']);
                break;
            case 'delete_employee':
                require_once Config::CONTROLLER_PATH . 'EmployeeController.php';
                EmployeeController::delete($_POST['id']);
                break;
            case 'get_employee':
                require_once Config::CONTROLLER_PATH . 'EmployeeController.php';
                EmployeeController::getById($_POST['employee_id']);
                break;
            case 'insert_area':
                require_once Config::CONTROLLER_PATH . 'AreaController.php';
                AreaController::insert($_POST['name']);
                break;
            case 'update_area':
                require_once Config::CONTROLLER_PATH . 'AreaController.php';
                AreaController::update($_POST['id'], $_POST['name']);
                break;
            case 'get_area':
                require_once Config::CONTROLLER_PATH . 'AreaController.php';
                AreaController::getById($_POST['id']);
                break;
            case 'delete_area':
                require_once Config::CONTROLLER_PATH . 'AreaController.php';
                AreaController::delete($_POST['id']);
                break;
            case 'insert_job':
                require_once Config::CONTROLLER_PATH . 'JobController.php';
                JobController::insert($_POST['name']);
                break;
            case 'update_job':
                require_once Config::CONTROLLER_PATH . 'JobController.php';
                JobController::update($_POST['id'], $_POST['name']);
                break;
            case 'get_job':
                require_once Config::CONTROLLER_PATH . 'JobController.php';
                JobController::getById($_POST['id']);
                break;
            case 'delete_job':
                require_once Config::CONTROLLER_PATH . 'JobController.php';
                JobController::delete($_POST['id']);
                break;
            default:
                echo Message::transformResponse('FAIL', "No action selected");
                break;
        }
    }
} else {
    echo Message::transformResponse('FAIL', "You're disabled to get the request");
}
