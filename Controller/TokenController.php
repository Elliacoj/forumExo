<?php


namespace App\Controller;


use App\Model\Entity\Token;
use App\Model\Entity\UserRole;
use App\Model\Manager\RoleManager;
use App\Model\Manager\TokenManager;
use App\Model\Manager\Traits\TraitsManager;
use App\Model\Manager\UserManager;
use App\Model\Manager\UserRoleManager;

class TokenController {
    use TraitsManager;

    /**
     * Create a token and send mail
     * @param $userFk
     */
    public function createUser($userFk) {
        $tabString = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
        $tabNumber = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $token = "";

        for($x = 0; $x < 10; $x++) {
            $token .= $tabString[rand(0, 25)] . $tabNumber[rand(0,9)];
        }

        $user = UserManager::getManager()->search($userFk);
        $role = RoleManager::getManager()->search(3);
        $userRole = new UserRole(null, $user, $role);
        UserRoleManager::getManager()->add($userRole);
        TokenManager::getManager()->add((new Token(null, $token, $user)));

        header("Location: ../index.php?controller=token&action=check&token=$token$userFk");
        /*$contentMail = "localhost:8080/index.php?controller=token&action=check&token=$token$userFk";
        $userMail = $user->getMail();
        mail("$userMail", "Inscription", $contentMail);*/
    }

    /**
     * Check token
     */
    public function check() {
        $token = filter_var($_GET['token'], FILTER_SANITIZE_STRING);
        $tokenCh = substr($token, 0, 20);
        $userFk = substr($token, 20);

        $tokenObject = TokenManager::getManager()->searchToken($tokenCh, $userFk);
        if($tokenObject !== null) {
            $user = UserManager::getManager()->search($userFk);

            $user->setActivated(true);
            UserManager::getManager()->updateActivated($user);

            $role = (UserRoleManager::getManager()->searchUser($user->getId()))->getRoleFk()->getId();

            $_SESSION['username'] = $user->getUsername();
            $_SESSION['id'] = $user->getId();
            $_SESSION['role'] = $role;

            TokenManager::getManager()->delete($tokenObject->getId());

            header("Location: ../index.php?error=5");
        }
        else {
            header("Location: ../index.php?error=6");
        }
    }
}