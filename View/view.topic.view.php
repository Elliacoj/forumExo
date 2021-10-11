<?php

use App\Model\Manager\CommentManager;
use App\Model\Manager\TopicManager;

$topic = TopicManager::getManager()->search($data['id']);
$commentaries = CommentManager::getManager()->get($topic->getId());
$modif = "";
if($topic->getModify() !== 0) {
    $modif = "Mise à jour le: ";
}

$status = "Ouvert";

if($topic->getStatus() === 1) {
    $status = "Archivé";
}

 ?>

<h2><?= $topic->getCategoryFk()->getName() ?></h2>

<div id="topicDiv">
    <div id="titleTopicView"><?= $topic->getTitle() ?></div>
    <div id="contentTopicView"><?= $topic->getContent() ?></div>
    <div class="footerTopicList">
        <span>Par: <?= $topic->getUserFk()->getUsername() ?></span>
        <span><?= $status ?></span>
        <span><?= $modif . date("d M Y", strtotime($topic->getDatetime())) ?></span>
    </div> <?php
    if(isset($_SESSION['id'], $_SESSION['role'])) {
        if(($_SESSION['id'] === $topic->getUserFk()->getId()) || $_SESSION['role'] !== 3) { ?>
        <div id="deleteTopic" data-id="<?= $topic->getId() ?>"><i class="fas fa-trash-alt" title="Supprimer"></i></div>
        <div id="updateTopic" data-id="<?= $topic->getId() ?>"><i class="fas fa-pen" title="Modifier"></i></div>
        <div id="archivedTopic" data-id="<?= $topic->getId() ?>"><i class="fas fa-archive"></i></div> <?php
        }
    } ?>
</div>

<div>
    <input type="button" value="Retour" id="backButtonTopic" class="buttonSubmit backButton">
</div>

