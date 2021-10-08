<?php

use App\Model\Manager\CategoryManager;

$categories = CategoryManager::getManager()->get();
?>
<h2>Panel d'administration</h2>
<div class="administrationDiv">
    <div>
        <h3>Catégories</h3>
        <p class="dropdownList">></p>
    </div>
    <div class="firstDivAdmin">
        <h4>Ajouter une catégorie</h4>
        <form>
            <div>
                <label for="addName">Nom de catégorie:</label>
                <input type="text" id="addName" name="addName">
            </div>
            <div>
                <input type="submit" class="buttonSubmit">
            </div>
        </form>
    </div>

    <div>
        <h4>Modifier une catégorie</h4>
        <form>
            <div>
                <label for="updateName">Nouveau nom:</label>
                <input type="text" id="updateName" name="updateName">
            </div>
            <div>
                <label for="updateCategory">Catégorie:</label>
                <select name="updateCategory" id="updateCategory"> <?php
                    foreach ($categories as $category) { ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option> <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" class="buttonSubmit">
            </div>
        </form>
    </div>

    <div>
        <h4>Supprimer une catégorie</h4>
        <form>
            <div>
                <label for="updateCategory">Catégorie:</label>
                <select name="updateCategory" id="updateCategory"> <?php
                    foreach ($categories as $category) { ?>
                        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option> <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" class="buttonSubmit" value="Supprimer">
            </div>
        </form>
    </div>
</div>
