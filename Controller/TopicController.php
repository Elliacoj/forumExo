<?php


namespace App\Controller;


use App\Controller\Traits\RenderController;
use App\Model\Entity\Topic;
use App\Model\Manager\CategoryManager;
use App\Model\Manager\TopicManager;
use App\Model\Manager\UserManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

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
     * @param $log
     */
    public function create() {
        $title = filter_var($_POST['createTitleTopic'], FILTER_SANITIZE_STRING);
        $content = nl2br(filter_var($_POST['createContentTopic'], FILTER_SANITIZE_STRING));
        $user = UserManager::getManager()->search($_SESSION['id']);
        $category = CategoryManager::getManager()->search($_SESSION['category']);

        $topic = new Topic(null, $title, $content, $user, $category);
        TopicManager::getManager()->add($topic);

        if($_SESSION['role'] === 2) {
            $log = new Logger('LogAdmin');
            $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
            $log->info("Le modérateur " . $_SESSION['username'] . " a crée le sujet " . $title);
        }

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
        if(isset($_SESSION['topic'])) {
            $idTopic = filter_var($_SESSION['topic'], FILTER_SANITIZE_NUMBER_INT);
            $_SESSION['topicUpdate'] = $_SESSION['topic'];
            unset($_SESSION['topic']);

            $this->render("update.topic", "Sujet", ["id" => $idTopic]);
        }
        else {
            header("Location: /index.php");
        }
    }

    /**
     * Add a new topic into topic table
     */
    public function updateConfirm() {
        $title = filter_var($_POST['updateTitleTopic'], FILTER_SANITIZE_STRING);
        $content = nl2br(filter_var($_POST['updateContentTopic'], FILTER_SANITIZE_STRING));
        if($_SESSION['role'] === 2) {
            $log = new Logger('LogAdmin');
            $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
            $log->info("Le modérateur " . $_SESSION['username'] . " a mise à jour le sujet " . $title);
        }

        $topic = TopicManager::getManager()->search($_SESSION['topicUpdate']);
        $topic->setTitle($title)->setContent($content)->setModify(1);
        unset($_SESSION['topicUpdate']);

        TopicManager::getManager()->update($topic);

        header("Location: /index.php?controller=topic&action=view&topic=" . $topic->getId() ."");
    }

    /**
     * Add a new topic into topic table
     */
    public function archived() {
        if(isset($_SESSION['topic'])) {
            $topic = TopicManager::getManager()->search($_SESSION['topic']);
            if($topic->getStatus() === 0) {
                if($_SESSION['role'] === 2) {
                    $log = new Logger('LogAdmin');
                    $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
                    $log->info("Le modérateur " . $_SESSION['username'] . " a archivé le sujet " . $topic->getTitle());
                }
                $topic->setStatus(1);
            }
            else {
                if($_SESSION['role'] === 2) {
                    $log = new Logger('LogAdmin');
                    $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
                    $log->info("Le modérateur " . $_SESSION['username'] . " a désarchivé le sujet " . $topic->getTitle());
                }
                $topic->setStatus(0);
            }

            TopicManager::getManager()->updateStatus($topic);
            unset($_SESSION['topic']);

            header("Location: /index.php?controller=topic&action=view&topic=" . $topic->getId() ."");
        }
        else {
            header("Location: /index.php");
        }
    }

    public function delete() {
        if(isset($_SESSION['topic'])) {
            $topic = TopicManager::getManager()->search(filter_var($_SESSION['topic'], FILTER_SANITIZE_NUMBER_INT));
            $category = $topic->getCategoryFk()->getName();
            if($topic->getStatus() !== 1 || $_SESSION['role'] !== 3) {
                if($_SESSION['role'] === 2) {
                    $log = new Logger('LogAdmin');
                    $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
                    $log->info("Le modérateur " . $_SESSION['username'] . " a supprimé le sujet " . $topic->getTitle());
                }

                TopicManager::getManager()->delete($topic->getId());
                unset($_SESSION['topic']);
            }

            header("Location: /index.php?controller=home&action=redirectCategory&category=" . $category ."");
        }
        else {
            header("Location: /index.php");
        }
    }
}