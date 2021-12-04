<?php
require_once "config.php";
if (isset($_POST)) {
    if (isset($_POST['function'])) {
        switch ($_POST['function']) {
            case 'insert_employee':
                require_once Config::CONTROLLER_PATH . 'EmployeeController.php';
                EmployeeController::insert($_POST['name'], $_POST['genre'], $_POST['area_id']);
                break;
            case 'update_employee':
                require_once Config::CONTROLLER_PATH . 'EmployeeController.php';
                EmployeeController::update($_POST['id'], $_POST['name'], $_POST['genre'], $_POST['area_id']);
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
            default:
                echo Message::transformResponse('FAIL', "No action selected");
                break;
        }
    }
} else {
    echo Message::transformResponse('FAIL', "You're disabled to get the request");
}
