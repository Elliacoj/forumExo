<?php


namespace App\Model\Manager;


use App\Model\Entity\Token;
use App\Model\Manager\Traits\TraitsManager;

class TokenManager {
    use TraitsManager;

    /**
     * Add a data into Token table
     * @param Token $token
     * @return bool
     */
    public function add(Token $token):bool {
        $userFk = $token->getUserFk()->getId();
        $token = $token->getToken();

        $data = ["token" => $token, "userFk" => $userFk];

        return ObjectManager::add("INSERT INTO ellia_token (user_fk, token) VALUES(:userFk, :token)", $data);
    }

    /**
     * Update a data into Token table
     * @param Token $token
     * @return bool
     */
    public function update(Token $token):bool {
        $id = $token->getId();
        $userFk = $token->getUserFk()->getId();
        $token = $token->getToken();

        $data = ["token" => $token, "userFk" => $userFk, "id" => $id];

        return ObjectManager::update("UPDATE ellia_token SET user_fk = :userFk, token = :token WHERE id = :id", $data);
    }

    /**
     * Delete a data into Token table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_token WHERE id = '$id'");
    }

    /**
     * Return a token
     * @param $token
     * @param $userFk
     * @return Object
     */
    public function searchToken($token, $userFk):?Object {
        return ObjectManager::search("SELECT * FROM ellia_token WHERE token = '$token' AND user_fk = '$userFk'", Token::class);
    }

    /**
     * Return a table of all token
     * @return array
     */
    public function get():array {
        return ObjectManager::get("SELECT * FROM ellia_token", Token::class);
    }
}