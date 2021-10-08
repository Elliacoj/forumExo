<div id="home">
    <h1>News land</h1> <?php

    if(isset($_SESSION['id'], $_SESSION['username'])) { ?>
    <div id="divWelcomeUser">
        <p id="welcomeUser">Bienvenu <?= $_SESSION['username'] ?></p>
    </div> <?php
    } ?>
</div>
