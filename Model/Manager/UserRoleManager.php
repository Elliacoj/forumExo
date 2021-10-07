<?php


namespace App\Model\Manager;


use App\Model\Entity\UserRole;
use App\Model\Manager\Traits\TraitsManager;

class UserRoleManager {
    use TraitsManager;

    /**
     * Add a data into UserRole table
     * @param UserRole $userRole
     * @return bool
     */
    public function add(UserRole $userRole):bool {
        $userFk = $userRole->getUserFk()->getId();
        $roleFk = $userRole->getRoleFk()->getId();

        $data = ["userFk" => $userFk, "roleFk" => $roleFk];

        return ObjectManager::add("INSERT INTO ellia_user_role (user_fk, role_fk) VALUES(:userFk, :roleFk)", $data);
    }

    /**
     * Update a data into UserRole table
     * @param UserRole $userRole
     * @return bool
     */
    public function update(UserRole $userRole):bool {
        $id = $userRole->getId();
        $userFk = $userRole->getUserFk()->getId();
        $roleFk = $userRole->getRoleFk()->getId();

        $data = ["userFk" => $userFk, "roleFk" => $roleFk, "id" => $id];

        return ObjectManager::update("UPDATE ellia_user_role SET name = :name WHERE id = :id", $data);
    }

    /**
     * Delete a data into UserRole table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_user_role WHERE id = '$id'");
    }

    /**
     * Return a userRole
     * @param $userFk
     * @return Object
     */
    public function searchUser($userFk):?Object {
        return ObjectManager::search("SELECT * FROM ellia_user_role WHERE user_fk = '$userFk'", UserRole::class);
    }

    /**
     * Return a table of all userRole
     * @return array
     */
    public function get():array {
        return ObjectManager::get("SELECT * FROM ellia_user_role", UserRole::class);
    }
}