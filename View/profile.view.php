<?php
$user = $data['user'];
?>
<h2>Votre profil</h2>
<div id="profileDiv">
    <p>Nom d'utilisateur: <span><?= $user->getUsername() ?></span></p>
    <p>Adresse Mail: <span><?= $user->getMail() ?></span></p>
    <div><a href="">Changer de mot de passe</a></div> <?php
    if(isset($_SESSION['id'], $_SESSION['username'], $_SESSION['role'])) {
        if($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
    <div><a href="../index.php?controller=home&action=administration">Panel d'administration</a></div> <?php
        }
    } ?>
</div>