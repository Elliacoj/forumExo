<?php

use App\Model\Manager\CategoryManager;
use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;

$categories = CategoryManager::getManager()->get();
$allUser = array_slice((UserManager::getManager()->get()), 1);
$allRole = array_slice((RoleManager::getManager()->get()), 1);

if(!isset($_SESSION['id'], $_SESSION['role'], $_SESSION['username'])) {
    header("Location: ../index.php?controller=user&error=10");
}
?>
<h2>Panel d'administration</h2> <?php
if(isset($_SESSION['role']) && $_SESSION['role'] === 1) { ?>
<div class="administrationDiv">
    <div class="firstDivAdmin">
        <h3>Catégories</h3>
        <p class="dropdownList"><i class="fas fa-arrows-alt-v"></i></p>
    </div>
    <div class="firstDivAdmin">
        <h4>Ajouter une catégorie</h4>
        <form>
            <div>
                <label for="addName">Nom de catégorie:</label>
                <input type="text" id="addName" name="addName">
            </div>
            <div>
                <input type="button" class="buttonSubmit" value="Envoyer" id="sendNewCategory">
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
                <select name="updateCategory" id="updateCategory" class="dropDownCategories"></select>
            </div>
            <div>
                <input type="button" class="buttonSubmit" value="Envoyer" id="sendUpdateCategory">
            </div>
        </form>
    </div>

    <div>
        <h4>Supprimer une catégorie</h4>
        <form>
            <div>
                <label for="deleteCategory">Catégorie:</label>
                <select name="deleteCategory" id="deleteCategory" class="dropDownCategories"></select>
            </div>
            <div>
                <input type="button" class="buttonSubmit" value="Supprimer" id="sendDeleteCategory">
            </div>
        </form>
    </div>
</div> <?php
} ?>

<div class="administrationDiv">
    <div class="firstDivAdmin">
        <h3>Utilisateurs</h3>
        <p class="dropdownList"><i class="fas fa-arrows-alt-v"></i></p>
    </div>
    <div class="firstDivAdmin">
        <h4>Modifier le role</h4>
        <form>
            <div>
                <label for="updateUserRole">Utilisateur:</label>
                <select name="updateUserRole" id="updateUserRole" class="dropDownUser"></select>
            </div>
            <div>
                <label for="updateRole">Role:</label>
                <select name="updateRole" id="updateRole"></select>
            </div>
            <div>
                <input type="button" class="buttonSubmit" value="Envoyer" id="sendUpdateRole">
            </div>
        </form>
    </div>

    <div>
        <h4>Bannir un utilisateur</h4>
        <form>
            <div>
                <label for="banUser">Utilisateur:</label>
                <select name="banUser" id="banUser" class="dropDownUser"></select>
            </div>
            <div>
                <input type="button" class="buttonSubmit" value="Bannir" id="sendBanUser">
            </div>
        </form>
    </div>

    <div>
        <h4>Débannir un utilisateur</h4>
        <form>
            <div>
                <label for="unbanUser">Utilisateur:</label>
                <select name="unbanUser" id="unbanUser" class="dropDownUser"></select>
            </div>
            <div>
                <input type="button" class="buttonSubmit" value="Débannir" id="sendUnbanUser">
            </div>
        </form>
    </div>
</div>

