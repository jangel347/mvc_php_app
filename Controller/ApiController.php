<?php
require_once "config.php";
if (isset($_POST)) {
    if (isset($_POST['function'])) {
        switch ($_POST['function']) {
            case 'insert_employee':
                require_once Config::CONTROLLER_PATH . 'EmployeeController.php';
                EmployeeController::insert($_POST['name'], $_POST['genre'], $_POST['area_id']);
                // echo json_encode($_POST);
                break;
            default:
                echo Message::transformResponse('FAIL', "Any action is selected");
                break;
        }
    }
} else {
    echo Message::transformResponse('FAIL', "You're disabled to get the request");
}
