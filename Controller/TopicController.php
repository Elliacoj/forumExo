<?php


namespace App\Controller;


use App\Controller\Traits\RenderController;
use App\Model\Entity\Topic;
use App\Model\Manager\CategoryManager;
use App\Model\Manager\TopicManager;
use App\Model\Manager\UserManager;

class TopicController {
    use RenderController;

    /**
     * Redirects into topic create page
     */
    public function home() {
        $this->render("topic.create", "Nouveau sujet");
    }

    /**
     * Add a new topic into topic table
     */
    public function create() {
        $title = filter_var($_POST['createTitleTopic'], FILTER_SANITIZE_STRING);
        $content = nl2br(filter_var($_POST['createContentTopic'], FILTER_SANITIZE_STRING));
        $user = UserManager::getManager()->search($_SESSION['id']);
        $category = CategoryManager::getManager()->search($_SESSION['category']);

        $topic = new Topic(null, $title, $content, $user, $category);
        TopicManager::getManager()->add($topic);

        header("Location: /index.php?controller=home&action=redirectCategory&category=" . $category->getName() ."");
    }

    /**
     * Redirects into view.topic page
     */
    public function view() {
        $idTopic = filter_var($_GET['topic'], FILTER_SANITIZE_NUMBER_INT);

        $this->render("view.topic", "Sujet", ["id" => $idTopic]);
    }

    /**
     * Redirects into update.topic page
     */
    public function update() {
        $idTopic = filter_var($_SESSION['topic'], FILTER_SANITIZE_NUMBER_INT);

        $this->render("update.topic", "Sujet", ["id" => $idTopic]);
    }

    /**
     * Add a new topic into topic table
     */
    public function updateConfirm() {
        $title = filter_var($_POST['updateTitleTopic'], FILTER_SANITIZE_STRING);
        $content = nl2br(filter_var($_POST['updateContentTopic'], FILTER_SANITIZE_STRING));

        $topic = TopicManager::getManager()->search($_SESSION['topic']);
        $topic->setTitle($title)->setContent($content)->setModify(1);

        TopicManager::getManager()->update($topic);

        header("Location: /index.php?controller=topic&action=view&topic=" . $topic->getId() ."");
    }

    /**
     * Add a new topic into topic table
     */
    public function archived() {
        $topic = TopicManager::getManager()->search($_SESSION['topic']);
        if($topic->getStatus() === 0) {
            $topic->setStatus(1);
        }
        else {
            $topic->setStatus(0);
        }

        TopicManager::getManager()->updateStatus($topic);

        header("Location: /index.php?controller=topic&action=view&topic=" . $topic->getId() ."");
    }

    public function delete() {
        $topic = TopicManager::getManager()->search(filter_var($_SESSION['topic'], FILTER_SANITIZE_NUMBER_INT));
        $category = $topic->getCategoryFk()->getName();
        TopicManager::getManager()->delete($topic->getId());

        header("Location: /index.php?controller=home&action=redirectCategory&category=" . $category ."");
    }
}