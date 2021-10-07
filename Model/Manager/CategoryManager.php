<?php


namespace App\Model\Manager;


use App\Model\Entity\Category;
use App\Model\Manager\Traits\TraitsManager;

class CategoryManager {
    use TraitsManager;

    /**
     * Add a data into Category table
     * @param Category $category
     * @return bool
     */
    public function add(Category $category):bool {
        $name = $category->getName();

        $data = ["name" => $name];

        return ObjectManager::add("INSERT INTO ellia_category (name) VALUES(:name)", $data);
    }

    /**
     * Update a data into Category table
     * @param Category $category
     * @return bool
     */
    public function update(Category $category):bool {
        $id = $category->getId();
        $name = $category->getName();

        $data = ["name" => $name, "id" => $id];

        return ObjectManager::update("UPDATE ellia_category SET name = :name WHERE id = :id", $data);
    }

    /**
     * Delete a data into Category table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_category WHERE id = '$id'");
    }

    /**
     * Return a category
     * @param $id
     * @return Object
     */
    public function search($id):?Object {
        return ObjectManager::search("SELECT * FROM ellia_category WHERE id = '$id'", Category::class);
    }

    /**
     * Return a table of all categories
     * @return array
     */
    public function get():array {
        return ObjectManager::get("SELECT * FROM ellia_category", Category::class);
    }
}