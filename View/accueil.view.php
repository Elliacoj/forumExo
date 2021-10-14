<?php
use App\Model\Manager\TopicManager;
?>
<div id="home">
    <h1>News land</h1> <?php

    if(isset($_SESSION['id'], $_SESSION['username'])) { ?>
    <div id="divWelcomeUser">
        <p id="welcomeUser">Bienvenu <?= $_SESSION['username'] ?></p>
    </div> <?php
    }
    $allTopic = array_reverse(TopicManager::getManager()->get());
    if(count($allTopic) > 5) {
        $allTopic = array_slice($allTopic, 0, 5);
    } ?>

    <div id="categoryDiv"> <?php
        $x = 0;
        if(count($allTopic) !== 0) {
            foreach ($allTopic as $topic) {
                $modif = '';
                if($topic->getModify() === 1) {
                    $modif = "Modifié le: ";
                }?>
                <div class="topicDivRedirects" data-id="<?= $topic->getId() ?>">
                    <div class="titleTopicList"><?= $topic->getTitle() ?></div>
                    <div class="footerTopicList">
                        <span>Par: <?= $topic->getUserFk()->getUsername() ?></span>
                        <Span><?= $topic->getCategoryFk()->getName() ?></Span>
                        <span><?= $modif . date("d M Y", strtotime($topic->getDatetime())) ?></span>
                    </div>
                </div> <?php
                $x++;
                if($x === 4) {
                    break;
                }
            }
        }
        else { ?>
            <div id="nothingDiv">Aucun sujet n'a encore été créé.</div> <?php
        } ?>

    </div>
</div>
