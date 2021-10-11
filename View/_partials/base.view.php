<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/d04d787520.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../asset/css/generalStyle.css">
    <link rel="stylesheet" href="../../asset/css/administrationStyle.css">
    <link rel="stylesheet" href="../../asset/css/mediaQueryStyle.css">
    <title><?= $title ?></title>
</head>
<body>
<?php require_once "menu.view.php"; ?>
<?= $html ?>
    <script src="../../asset/js/menuAndLogin.js"></script> <?php

if(isset($_GET['action'], $_GET['controller']) && $_GET['action'] === "administration" && $_GET['controller'] === "home") { ?>
    <script src="../../asset/js/administration.js"></script> <?php
} ?>
    <script src="../../asset/js/topicAndComment.js"></script>
</body>
</html>
