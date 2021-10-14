<?php

use App\Model\Manager\CommentManager;
use App\Model\Manager\UserManager;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "PUT":
        $data = json_decode(file_get_contents('php://input'));
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

    foreach ($comments as $comment) {
        if($comment->getReport() !== 0) {
            $userReport = UserManager::getManager()->search($comment->getReport());
            $allComment[] = [
                'id' => $comment->getId(), 'content' => $comment->getContent(), 'topicFk' => $comment->getTopicFk()->getId(),
                'usernameReport' => $userReport->getUsername(), 'username' => $comment->getUserFk()->getUsername(), "idUser" => $comment->getUserFk()->getId(),
                'topicName' => $comment->getTopicFk()->getTitle()
                ];
        }
        return json_encode($allComment);
    }
}