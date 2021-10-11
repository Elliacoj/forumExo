<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "PUT":
        $data = json_decode(file_get_contents('php://input'));
        $_SESSION['topic'] = $data->session;
        break;
}