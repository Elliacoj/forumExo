<?php


namespace App\Model\Manager;


use App\Model\Entity\SubComment;
use App\Model\Manager\Traits\TraitsManager;

class SubCommentManager {
    use TraitsManager;

    /**
     * Add a data into SubComment table
     * @param SubComment $subComment
     * @return bool
     */
    public function add(SubComment $subComment):bool {
        $content = $subComment->getContent();
        $userFk = $subComment->getUserFk()->getId();
        $commentFk = $subComment->getCommentFk()->getId();

        $data = ["userFk" => $userFk, "commentFk" => $commentFk, "content" => $content];

        return ObjectManager::add("INSERT INTO ellia_sub_comment (user_fk, comment_fk, comment) VALUES(:userFk, :commentFk, :content)", $data);
    }

    /**
     * Update a data into SubComment table
     * @param SubComment $subComment
     * @return bool
     */
    public function update(SubComment $subComment):bool {
        $id = $subComment->getId();
        $content = $subComment->getContent();
        $userFk = $subComment->getUserFk()->getId();
        $commentFk = $subComment->getCommentFk()->getId();

        $data = ["userFk" => $userFk, "commentFk" => $commentFk, "content" => $content, "id" => $id];

        return ObjectManager::update("UPDATE ellia_sub_comment SET user_fk = :userFk, commment_fk = :commentFk, content = :content WHERE id = :id", $data);
    }

    /**
     * Update a data into SubComment table
     * @param SubComment $subComment
     * @return bool
     */
    public function updateReport(SubComment $subComment):bool {
        $id = $subComment->getId();
        $report = $subComment->getReport();

        $data = ["report" => $report, "id" => $id];

        return ObjectManager::update("UPDATE ellia_sub_comment SET report = :report WHERE id = :id", $data);
    }

    /**
     * Delete a data into SubComment table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_sub_comment WHERE id = '$id'");
    }

    /**
     * Return a subComment
     * @param $id
     * @return Object
     */
    public function search($id):Object {
        return ObjectManager::search("SELECT * FROM ellia_sub_comment WHERE id = '$id'", SubComment::class);
    }

    /**
     * Return a table of all subComment with specify commentFk
     * @param $commentFk
     * @return array
     */
    public function get($commentFk):array {
        return ObjectManager::get("SELECT * FROM ellia_sub_comment WHERE topic_fk = '$commentFk'", SubComment::class);
    }
}