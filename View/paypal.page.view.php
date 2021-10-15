<?php
$user = \App\Model\Manager\UserManager::getManager()->search($_SESSION['id']);
?>
<div id="paypalDiv"> <?php
    if($user->getPremium() === 0) { ?>
    <form action="../index.php?controller=paypal&action=createInstance" method="post">
        <label for="">Désirez-vous payer 10 euros (pour 1 mois) pour être membre premium? </label>
        <input type="submit" value="Confirmer">
    </form> <?php
    }
    else { ?>
    <p>Votre compte est premium</p> <?php
    } ?>
</div>