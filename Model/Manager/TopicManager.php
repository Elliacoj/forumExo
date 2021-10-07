<?php


namespace App\Model\Manager;


use App\Model\Entity\Topic;
use App\Model\Manager\Traits\TraitsManager;

class TopicManager {
    use TraitsManager;

    /**
     * Add a data into Topic table
     * @param Topic $topic
     * @return bool
     */
    public function add(Topic $topic):bool {
        $title = $topic->getTitle();
        $content = $topic->getContent();
        $userFk = $topic->getUserFk()->getId();
        $category = $topic->getCategoryFk()->getId();

        $data = ["title" => $title, "content" => $content, "userFk" => $userFk, "category" => $category];

        return ObjectManager::add("INSERT INTO ellia_topic (title, content, user_fk, category) VALUES(:title, :content, :userFk, :category)", $data);
    }

    /**
     * Update a data into Topic table
     * @param Topic $topic
     * @return bool
     */
    public function update(Topic $topic):bool {
        $id = $topic->getId();
        $title = $topic->getTitle();
        $content = $topic->getContent();
        $userFk = $topic->getUserFk()->getId();
        $category = $topic->getCategoryFk()->getId();
        $datetime = date("Y-m-d H:i:s");
        $modify = $topic->getModify();

        $data = [
            "title" => $title, "content" => $content, "userFk" => $userFk, "category" => $category, "id" => $id,
            "datetime" => $datetime, "modify" => $modify
        ];

        return ObjectManager::update(
            "UPDATE ellia_topic SET title = :title, content = :content, user_fk = :userFk, category = :category, modify = :modify 
                 WHERE id = :id", $data
        );
    }

    /**
     * Update a data into Topic table
     * @param Topic $topic
     * @return bool
     */
    public function updateStatus(Topic $topic):bool {
        $id = $topic->getId();
        $status = $topic->getStatus();

        $data = ["status" => $status, "id" => $id];

        return ObjectManager::update("UPDATE ellia_topic SET status = :status WHERE id = :id", $data);
    }

    /**
     * Delete a data into Topic table
     * @param $id
     * @return bool
     */
    public function delete($id): bool {
        return ObjectManager::delete("DELETE FROM ellia_topic WHERE id = '$id'");
    }

    /**
     * Return a topic
     * @param $id
     * @return Object
     */
    public function search($id):?Object {
        return ObjectManager::search("SELECT * FROM ellia_topic WHERE id = '$id'", Topic::class);
    }

    /**
     * Return a table of all topic
     * @param $categoryFk
     * @return array
     */
    public function getByCategory($categoryFk):array {
        return ObjectManager::get("SELECT * FROM ellia_topic WHERE category_fk = $categoryFk", Topic::class);
    }
}