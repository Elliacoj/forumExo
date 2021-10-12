<?php

use App\Model\Manager\TopicManager;

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "PUT":
        $data = json_decode(file_get_contents('php://input'));
        $topic = TopicManager::getManager()->search(filter_var($data->session, FILTER_SANITIZE_NUMBER_INT));

        if($topic->getUserFk()->getId() === $_SESSION['id'] || $_SESSION['role'] !== 3) {
            $_SESSION['topic'] = $data->session;
        }
        break;
}