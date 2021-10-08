<?php

use App\Model\Entity\Category;
use App\Model\Manager\CategoryManager;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "GET":
        echo getCategories();
        break;
    case "POST":
        setCategory(json_decode(file_get_contents('php://input')));
        break;
}

function getCategories() {
    $categories = CategoryManager::getManager()->get();
    $allCategories = [];

    foreach($categories as $category) {
        $allCategories[] = ["name" => $category->getName(), "id" => $category->getId()];
    }
    return json_encode($allCategories);
}

function setCategory($data) {
    CategoryManager::getManager()->add(new Category(null, $data->name));
}
