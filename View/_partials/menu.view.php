<nav>
    <div><a href="../../index.php" title="Page accueil">Accueil</a></div>
    <div id="categoryList">Catégories</div>
    <div><a href="../../index.php?controller=home&action=profile" title="Votre profil">Profil</a></div>
    <div><a href="../../index.php?controller=home&action=regulation" title="Page réglement">Réglement</a></div> <?php

    if(isset($_SESSION['id'], $_SESSION["username"])) { ?>
    <div><a href="../../index.php?controller=user&action=logout" title="Vous déconnectez">Déconnexion</a></div> <?php
    }
    else { ?>
    <div><a href="../../index.php?controller=user" title="Page connexion/inscription">Connexion</a></div> <?php
    } ?>
</nav>
