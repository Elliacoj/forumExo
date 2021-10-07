<?php

use App\Model\Manager\CategoryManager;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "GET":
        getCategories();
        break;
}

function getCategories() {
    $categories = CategoryManager::getManager()->get();
    $allCategories = [];

    foreach($categories as $category) {
        $allCategories[] = $category->getName();
    }
    return json_encode($allCategories);
}
