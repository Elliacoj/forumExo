<div id="home">
    <h1>News land</h1> <?php

    if(isset($_SESSION['id'], $_SESSION['username'])) { ?>
    <p>Bienvenu <?= $_SESSION['username'] ?></p> <?php
    } ?>


</div>
