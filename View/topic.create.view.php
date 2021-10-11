<?php

use App\Model\Manager\CategoryManager;

$category = CategoryManager::getManager()->search(filter_var($_SESSION['category'], FILTER_SANITIZE_STRING));
?>
<h2>Nouveau sujet (<?= $category->getName() ?>)</h2>

<div id="newTopic">
    <form action="/index.php?controller=topic&action=create" method="post">
        <div>
            <label for="createTitleTopic">Titre du sujet</label>
            <input type="text" name="createTitleTopic" id="createTitleTopic">
        </div>
        <div>
            <label for="createContentTopic">Contenu du sujet</label>
            <textarea name="createContentTopic" id="createContentTopic" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="Envoyer" class="buttonSubmit">
        </div>
    </form>
    <div>
        <input type="button" value="Retour" class="buttonSubmit backButton">
    </div>
</div>
