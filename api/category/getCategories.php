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
    case "PUT":
        updateCategory(json_decode(file_get_contents('php://input')));
        break;
    case "DELETE":
        deleteCategory(json_decode(file_get_contents('php://input')));
        break;
}

/**
 * Return all categories
 * @return false|string
 */
function getCategories() {
    $categories = CategoryManager::getManager()->get();
    $allCategories = [];

    foreach($categories as $category) {
        $allCategories[] = ["name" => $category->getName(), "id" => $category->getId()];
    }
    return json_encode($allCategories);
}

/**
 * Add a category into category table
 * @param $data
 */
function setCategory($data) {
    CategoryManager::getManager()->add(new Category(null, $data->name));
}

/**
 * Update a category into category table
 * @param $data
 */
function updateCategory($data) {
    CategoryManager::getManager()->update(new Category($data->id, $data->name));
}

/**
 * Delete a category into category table
 * @param $data
 */
function deleteCategory($data) {
    CategoryManager::getManager()->delete($data->id);
}
