<?php
require_once "config.php";
if (isset($_REQUEST['action_type'])) {
    require_once Config::CONTROLLER_PATH . $_REQUEST['action_type'] . 'Controller.php';
} else {
    echo Message::transformResponse('FAIL',"You're disabled to get the request");
}
