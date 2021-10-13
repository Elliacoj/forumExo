<?php

use App\Model\Manager\CategoryManager;
use App\Model\Manager\TopicManager;

$category = CategoryManager::getManager()->searchName(filter_var($_GET['category'], FILTER_SANITIZE_STRING));
$_SESSION['category'] = $category->getId();
$allTopic = TopicManager::getManager()->getByCategory($category->getId()); ?>

<h2><?= $category->getName() ?></h2>

<div id="categoryDiv"> <?php
    if(isset($_SESSION['id'], $_SESSION['role'])) { ?>
    <div id="createTopicButton"><a href="/index.php?controller=topic&action=home">Créer un sujet</a></div> <?php
    }
    if(count($allTopic) !== 0) {
        foreach ($allTopic as $topic) {
            $modif = '';
            if($topic->getModify() === 1) {
                $modif = "Mise à jour le: ";
            }
            $status = "Ouvert";

            if($topic->getStatus() === 1) {
                $status = "Archivé";
            } ?>
    <div class="topicDivRedirects" data-id="<?= $topic->getId() ?>">
        <div class="titleTopicList"><?= $topic->getTitle() ?></div>
        <div class="footerTopicList"><span>Par: <?= $topic->getUserFk()->getUsername() ?></span><span><?= $status ?></span><span><?= $modif . date("d M Y", strtotime($topic->getDatetime())) ?></span></div>
    </div> <?php
        }

    }
    else { ?>
    <div id="nothingDiv">Aucun sujet n'a encore été créé.</div> <?php
    } ?>

</div>