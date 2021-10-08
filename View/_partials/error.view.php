<?php
switch (filter_var($_GET['error'], FILTER_SANITIZE_NUMBER_INT)) {
    case "4": ?>
        <div class="errorGreen">Un mail d'activation vous a été envoyé!</div> <?php
        break;
    case "5": ?>
        <div class="errorGreen">Votre compte a bien été activé!</div> <?php
        break;
    case "6": ?>
        <div class="errorRed">Ce lien est erroné!</div> <?php
        break;
    case "7": ?>
        <div class="errorGreen">Vous avez été déconnecté!</div> <?php
        break;
    case "8": ?>
        <div class="errorRed">Le nom d'utilisateur ou le mot de passe ne correspond pas!</div> <?php
        break;
}
