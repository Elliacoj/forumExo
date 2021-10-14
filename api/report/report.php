<?php

use App\Model\Manager\CommentManager;
use App\Model\Manager\UserManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "PUT":
        $data = json_decode(file_get_contents('php://input'));
        report($data);
        break;
    case "GET":
        echo getCommentReport();
        break;
}

/**
 * Get all comments reported
 * @return false|string
 */
function getCommentReport() {
    $comments = CommentManager::getManager()->getAll();
    $allComment = [];

    foreach($comments as $comment) {
        if($comment->getReport() !== 0) {
            $userReport = UserManager::getManager()->search($comment->getReport());
            $allComment[] = [
                'id' => $comment->getId(), 'content' => $comment->getContent(), 'topicFk' => $comment->getTopicFk()->getId(),
                'usernameReport' => $userReport->getUsername(), 'username' => $comment->getUserFk()->getUsername(), "idUser" => $comment->getUserFk()->getId(),
                'topicName' => $comment->getTopicFk()->getTitle()
                ];
        }
    }
    return json_encode($allComment);
}

/**
 * Delete or change report for a comment into comment table
 * @param $data
 */
function report($data) {
    $comment = CommentManager::getManager()->search(filter_var($data->id, FILTER_SANITIZE_NUMBER_INT));

    if($data->type === 0) {
        if($_SESSION['role'] === 2) {
            $log = new Logger('LogAdmin');
            $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
            $log->info("Le modérateur " . $_SESSION['username'] . " a annulé le signalement du message \"" .
                $comment->getContent() . "\" de l'utilisateur " . $comment->getUserFk()->getUsername());
        }

        $comment->setReport(0);
        CommentManager::getManager()->updateReport($comment);
    }
    else {
        if($_SESSION['role'] === 2) {
            $log = new Logger('LogAdmin');
            $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
            $log->info("Le modérateur " . $_SESSION['username'] . " a supprimé le message \"" .
                $comment->getContent() . "\" de l'utilisateur " . $comment->getUserFk()->getUsername());
        }

        CommentManager::getManager()->delete($comment->getId());
    }
}