<?php


namespace App\Model\Manager;


use App\Model\Entity\Role;
use App\Model\Manager\Traits\TraitsManager;

class RoleManager {
    use TraitsManager;

    /**
     * Add a data into Role table
     * @param Role $role
     * @return bool
     */
    public function add(Role $role):bool {
        $name = $role->getName();

        $data = ["name" => $name];

        return ObjectManager::add("INSERT INTO ellia_role (name) VALUES(:name)", $data);
    }

    /**
     * Update a data into Role table
     * @param Role $role
     * @return bool
     */
    public function update(Role $role):bool {
        $id = $role->getId();
        $name = $role->getName();

        $data = ["name" => $name, "id" => $id];

        return ObjectManager::update("UPDATE ellia_role SET name = :name WHERE id = :id", $data);
    }

    /**
     * Delete a data into Role table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_role WHERE id = '$id'");
    }

    /**
     * Return a role
     * @param $id
     * @return Object
     */
    public function search($id):?Object {
        return ObjectManager::search("SELECT * FROM ellia_role WHERE id = '$id'", Role::class);
    }

    /**
     * Return a table of all role
     * @return array
     */
    public function get():array {
        return ObjectManager::get("SELECT * FROM ellia_role", Role::class);
    }
}