<?php

use App\Model\Entity\Comment;
use App\Model\Manager\CommentManager;
use App\Model\Manager\TopicManager;
use App\Model\Manager\UserManager;

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
}

/**
 * Get all comment of a topic
 * @return false|string
 */
function getComment() {
    $topic = filter_var($_SESSION['topicComment'], FILTER_SANITIZE_NUMBER_INT);

    $comments = CommentManager::getManager()->get($topic);
    $allComments = [];
    foreach($comments as $comment) {
        $allComments[] = ['username' => $comment->getUserFk()->getUsername(), 'content' => $comment->getContent(), 'role' => $_SESSION['role'], 'user' => $_SESSION['id']];
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