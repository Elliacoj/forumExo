<?php

use App\Model\Entity\Comment;
use App\Model\Manager\CommentManager;
use App\Model\Manager\TopicManager;
use App\Model\Manager\UserManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "GET":
        echo getComment();
        break;
    case "POST":
        addComment(json_decode(file_get_contents('php://input')));
        break;
    case "DELETE":
        deleteComment(json_decode(file_get_contents('php://input')));
        break;
    case "REPORT":
        reportComment(json_decode(file_get_contents('php://input')));
        break;
    case "PUT":
        updateComment(json_decode(file_get_contents('php://input')));
        break;
}

/**
 * Get all comment of a topic
 * @return false|string
 */
function getComment() {
    $topic = filter_var($_SESSION['topicComment'], FILTER_SANITIZE_NUMBER_INT);
    $role = 0;
    $user = 0;

    if(isset($_SESSION['role'], $_SESSION['id'])) {
        $role = $_SESSION['role'];
        $user = $_SESSION['id'];
    }

    $comments = CommentManager::getManager()->get($topic);
    $allComments = [];
    foreach($comments as $comment) {
        $color = false;
        if(isset($_SESSION['id']) && $comment->getReport() === $_SESSION['id']) {
            $color = true;
        }
        $allComments[] = [
            "commentUserId" => $comment->getUserFk()->getId(), 'username' => $comment->getUserFk()->getUsername(),
            'content' => $comment->getContent(), 'role' => $role, 'user' => $user, "status" => $comment->getTopicFk()->getStatus(), "id" => $comment->getId(),
            "color" => $color
        ];
    }

    return json_encode($allComments);
}

/**
 * Add a comment into a topic
 * @param $data
 */
function addComment($data) {
    $content = nl2br(filter_var($data->content, FILTER_SANITIZE_STRING));
    $topic = TopicManager::getManager()->search(filter_var($_SESSION['topicComment'], FILTER_SANITIZE_NUMBER_INT));
    $user = UserManager::getManager()->search($_SESSION['id']);

    $comment = new Comment(null, $content, $user, $topic);
    CommentManager::getManager()->add($comment);
}

/**
 * Delete a comment into a topic
 * @param $data
 */
function deleteComment($data) {
    $comment = CommentManager::getManager()->search(filter_var($data->comment, FILTER_SANITIZE_NUMBER_INT));

    if($comment->getUserFk()->getId() === $_SESSION['id'] || $_SESSION['role'] !== 3) {
        if($comment->getTopicFk()->getStatus() !== 1 || $_SESSION['role'] === 1) {
            if($_SESSION['role'] === 2) {
                $log = new Logger('LogAdmin');
                $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
                $log->info("Le modérateur " . $_SESSION['username'] . " a supprimé le message \"" .
                    $comment->getContent() . "\" de l'utilisateur " . $comment->getUserFk()->getUsername());
            }

            CommentManager::getManager()->delete($comment->getId());
        }
    }
}

/**
 * Delete a comment into a topic
 * @param $data
 */
function reportComment($data) {
    $comment = CommentManager::getManager()->search(filter_var($data->comment, FILTER_SANITIZE_NUMBER_INT));
    if($comment->getReport() === $_SESSION['id']) {
        $comment->setReport(0);
    }
    else {
        $comment->setReport($_SESSION['id']);
    }

    CommentManager::getManager()->updateReport($comment);
}

/**
 * Update a comment into a topic
 * @param $data
 */
function updateComment($data) {
    $comment = CommentManager::getManager()->search(filter_var($data->comment, FILTER_SANITIZE_NUMBER_INT));
    if($comment->getUserFk()->getId() === $_SESSION['id'] || $_SESSION['role'] !== 3) {
        if($comment->getTopicFk()->getStatus() !== 1 || $_SESSION['role'] === 1) {
            if($_SESSION['role'] === 2) {
                $log = new Logger('LogAdmin');
                $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
                $log->info("Le modérateur " . $_SESSION['username'] . " a mise à jour le message \"" .
                    $comment->getContent() . "\" de l'utilisateur " . $comment->getUserFk()->getUsername());
            }

            $comment->setcontent(filter_var($data->content, FILTER_SANITIZE_STRING));
            CommentManager::getManager()->update($comment);
        }
    }
}