<?php


namespace App\Model\Manager;


use App\Model\Entity\User;
use App\Model\Manager\Traits\TraitsManager;

class UserManager {
    use TraitsManager;

    /**
     * Add a data into User table
     * @param User $user
     * @return bool
     */
    public function add(User $user):bool {
        $username = $user->getUsername();
        $password = $user->getPassword();
        $mail = $user->getMail();

        $data = ["username" => $username, "password" => $password, "mail" => $mail];

        return ObjectManager::add("INSERT INTO ellia_user (username, password, mail) VALUES(:username, :password, :mail)", $data);
    }

    /**
     * Update a data into User table
     * @param User $user
     * @return bool
     */
    public function update(User $user):bool {
        $id = $user->getId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $mail = $user->getMail();

        $data = ["id" => $id, "username" => $username, "password" => $password, "mail" => $mail];

        return ObjectManager::update("UPDATE ellia_user SET username = :username, password = :password, mail = :mail WHERE id = :id", $data);
    }

    /**
     * Update a data into User table
     * @param User $user
     * @return bool
     */
    public function updatePremium(User $user):bool {
        $id = $user->getId();
        $premium = $user->getPremium();
        $datePremium = $user->getDatePremium();


        $data = ["id" => $id, "premium" => $premium, "datePremium" => $datePremium];

        return ObjectManager::update("UPDATE ellia_user SET premium = :premium, date_premium = :datePremium WHERE id = :id", $data);
    }

    /**
     * Update a data into User table
     * @param User $user
     * @return bool
     */
    public function updateActivated(User $user):bool {
        $id = $user->getId();
        $activated = $user->getActivated();

        $data = ["id" => $id, "activated" => $activated];

        return ObjectManager::update("UPDATE ellia_user SET activated = :activated WHERE id = :id", $data);
    }

    /**
     * Delete a data into User table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_user WHERE id = '$id'");
    }

    /**
     * Return an user
     * @param $username
     * @return Object
     */
    public function searchUsername($username):?Object {
        return ObjectManager::search("SELECT * FROM ellia_user WHERE username = '$username'", User::class);
    }

    /**
     * Return an user
     * @param $mail
     * @return Object
     */
    public function searchMail($mail):?Object {
        return ObjectManager::search("SELECT * FROM ellia_user WHERE mail = '$mail'", User::class);
    }

    /**
     * Return an user
     * @param $id
     * @return Object
     */
    public function search($id):?Object {
        return ObjectManager::search("SELECT * FROM ellia_user WHERE id = '$id'", User::class);
    }

    /**
     * Return a table of all user
     * @return array
     */
    public function get():array {
        return ObjectManager::get("SELECT * FROM ellia_user", User::class);
    }
}