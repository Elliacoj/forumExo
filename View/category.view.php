<?php

use App\Model\Manager\CategoryManager;
use App\Model\Manager\TopicManager;

$category = CategoryManager::getManager()->searchName(filter_var($_GET['category'], FILTER_SANITIZE_STRING));

$allTopic = TopicManager::getManager()->getByCategory($category->getId()); ?>

<h2><?= $category->getName() ?></h2>

<div id="categoryDiv">
    <div id="createTopicButton"><a href="/index.php?controller=topic&action=create">Créer un sujet</a></div> <?php
    if(count($allTopic) !== 0) {
        foreach ($allTopic as $topic) {?>
    <div>
        <div><?= $topic->getName() ?></div>
        <div><?= date("d M Y", strtotime($topic->getDatetime())) ?></div>
    </div> <?php
        }

    }
    else { ?>
    <div id="nothingDiv">Aucun sujet n'a encore été créé.</div> <?php
    } ?>

</div>