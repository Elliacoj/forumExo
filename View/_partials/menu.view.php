<nav>
    <div><a href="" title="Page accueil">Accueil</a></div>
    <div id="categoryList">Catégories</div>
    <div><a href="" title="Votre profil">Profil</a></div>
    <div><a href="" title="Page réglement">Réglement</a></div> <?php

    if(isset($_SESSION['id'], $_SESSION["username"])) { ?>
    <div><a href="" title="Vous déconnectez">Déconnexion</a></div> <?php
    }
    else { ?>
    <div><a href="" title="Page connexion/inscription">Connexion</a></div> <?php
    } ?>
</nav>
