<?php


namespace App\Model\Manager;

use App\Model\Entity\Comment;
use App\Model\Manager\Traits\TraitsManager;

class CommentManager {
    use TraitsManager;

    /**
     * Add a data into Comment table
     * @param Comment $comment
     * @return bool
     */
    public function add(Comment $comment):bool {
        $userFk = $comment->getUserFk()->getId();
        $topicFk = $comment->getTopicFk()->getId();
        $content = $comment->getContent();

        $data = ["userFk" => $userFk, "topicFk" => $topicFk, "content" => $content];

        return ObjectManager::add("INSERT INTO ellia_comment (user_fk, topic_fk, comment) VALUES(:userFk, :topicFk, :content)", $data);
    }

    /**
     * Update a data into Comment table
     * @param Comment $comment
     * @return bool
     */
    public function update(Comment $comment):bool {
        $id = $comment->getId();
        $userFk = $comment->getUserFk()->getId();
        $topicFk = $comment->getTopicFk()->getId();
        $content = $comment->getContent();

        $data = ["userFk" => $userFk, "topicFk" => $topicFk, "content" => $content, "id" => $id];

        return ObjectManager::update("UPDATE ellia_comment SET user_fk = :userFk, topic_fk = :topicFk, content = :content WHERE id = :id", $data);
    }

    /**
     * Update a data into Comment table
     * @param Comment $comment
     * @return bool
     */
    public function updateReport(Comment $comment):bool {
        $id = $comment->getId();
        $report = $comment->getReport();

        $data = ["report" => $report, "id" => $id];

        return ObjectManager::update("UPDATE ellia_comment SET report = :report WHERE id = :id", $data);
    }

    /**
     * Delete a data into Comment table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_comment WHERE id = '$id'");
    }

    /**
     * Return a comment
     * @param $id
     * @return Object
     */
    public function search($id):Object {
        return ObjectManager::search("SELECT * FROM ellia_comment WHERE id = '$id'", Comment::class);
    }

    /**
     * Return a table of all comment with specify topicFk
     * @param $topicFk
     * @return array
     */
    public function get($topicFk):array {
        return ObjectManager::get("SELECT * FROM ellia_comment WHERE topic_fk = '$topicFk'", Comment::class);
    }
}