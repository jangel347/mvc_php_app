<?php
if (!defined("PROJECT_FOLDER")) define("PROJECT_FOLDER", $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/mvc_php_app/");
if (!defined("SERVER_URL")) define("SERVER_URL", 'http://localhost/mvc_php_app/');
class Config
{
    const PROJECT_FOLDER = PROJECT_FOLDER;
    const SERVER_URL = SERVER_URL;
    const PROJECT_PATH = "mvc_php_app/";
    const VIEW_PATH = self::SERVER_URL . "View/";
    const CONTROLLER_PATH = self::PROJECT_FOLDER . "Controller/";
    const MODEL_PATH = self::PROJECT_FOLDER . "Model/";
    const TEMPLATE_PATH = self::PROJECT_FOLDER . "template/";
    const CSS_PATH = self::SERVER_URL . "assets/css/";
    const JS_PATH = self::SERVER_URL . "assets/js/";
    const IMAGES_PATH = self::SERVER_URL . "assets/images/";
}

class Message
{
    static function transformResponse($status = false, $message = false, $data = false)
    {
        $response = [];
        if ($status)
            $response['status'] = $status;
        if ($message)
            $response['message'] = $message;
        if ($data)
            $response['data'] = $data;
        return json_encode($response);
    }
}
