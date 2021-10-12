<?php

use App\Model\Manager\TopicManager;

$topic = TopicManager::getManager()->search($data['id']);
?>
<h2>Mise à jour du sujet</h2>

<div id="newTopic">
    <form action="/index.php?controller=topic&action=updateConfirm" method="post">
        <div>
            <label for="updateTitleTopic">Titre du sujet</label>
            <input type="text" name="updateTitleTopic" id="updateTitleTopic" value="<?=  $topic->getTitle() ?>">
        </div>
        <div>
            <label for="updateContentTopic">Contenu du sujet</label>
            <textarea name="updateContentTopic" id="updateContentTopic" cols="30" rows="10"><?= str_replace("<br />", "", $topic->getContent()) ?></textarea>
        </div>
        <div>
            <input type="submit" value="Envoyer" class="buttonSubmit">
        </div>
    </form>

    <div>
        <a href="/index.php?controller=topic&action=view&topic=<?= $topic->getId() ?>">
            <input type="button" value="Retour" class="buttonSubmit backButton">
        </a>
    </div>
</div>
