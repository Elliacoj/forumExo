<?php


namespace App\Controller;


use App\Controller\Traits\RenderController;
use App\Model\Classes\DB;
use App\Model\Entity\User;
use App\Model\Manager\UserManager;

class UserController {
    use RenderController;

    /**
     * Redirects into connection page
     */
    public function homePage() {
        if(!isset($_SESSION['id'], $_SESSION['username'])) {
            $this->render("login.create", "Login/Create");
        }
        else {
            header("Location: /index.php");
        }
    }

    /**
     * Create an user
     */
    public function create() {
        $username = filter_var($_POST['createUsername'], FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['createMail'], FILTER_SANITIZE_STRING);
        $password = password_hash(filter_var($_POST['createPassword'], FILTER_SANITIZE_STRING), PASSWORD_BCRYPT);

        if(UserManager::getManager()->searchUsername($username) === null) {
            if(UserManager::getManager()->searchMail($mail) === null) {
                $user = new User();
                $user->setUsername($username)->setMail($mail)->setPassword($password);

                UserManager::getManager()->add($user);
                (new TokenController())->createUser(DB::getInstance()->lastInsertId());
                //header("Location: ../index.php?error=4");
            }
        }
    }
}