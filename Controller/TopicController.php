<?php


namespace App\Controller;


use App\Controller\Traits\RenderController;
use App\Model\Entity\Topic;
use App\Model\Manager\CategoryManager;
use App\Model\Manager\TopicManager;
use App\Model\Manager\UserManager;
use http\Exception\InvalidArgumentException;

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
        $content = filter_var($_POST['createContentTopic'], FILTER_SANITIZE_STRING);
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

        $this->render("view.topic", "Sujet");
    }
}