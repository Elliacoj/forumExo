<?php
$user = $data['user'];

if(!isset($_SESSION['id'], $_SESSION['role'], $_SESSION['username'])) {
    header("Location: ../index.php?controller=user&error=10");
}
?>
<h2>Votre profil</h2>
<div id="profileDiv">
    <p>Nom d'utilisateur: <span><?= $user->getUsername() ?></span></p>
    <p>Adresse Mail: <span><?= $user->getMail() ?></span></p>
    <div><a href="">Changer de mot de passe</a></div>
    <div><a href="../index.php?controller=home&action=paypalPage">Soutenir le forum</a></div><?php
    if(isset($_SESSION['id'], $_SESSION['username'], $_SESSION['role'])) {
        if($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
    <div><a href="../index.php?controller=home&action=administration">Panel d'administration</a></div> <?php
        }
    }
    if(isset($_SESSION['id'], $_SESSION['username'], $_SESSION['role'])) {
    if($_SESSION['role'] === 1) { ?>
    <div><a href="../index.php?controller=home&action=monologPage">Monolog</a></div> <?php
        }
    } ?>
</div>