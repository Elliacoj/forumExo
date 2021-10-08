<?php


namespace App\Controller;


use App\Controller\Traits\RenderController;
use App\Model\Classes\DB;
use App\Model\Entity\User;
use App\Model\Manager\UserManager;
use App\Model\Manager\UserRoleManager;

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

    /**
     * Disconnect the user
     */
    public function logout() {
        if(isset($_SESSION['id'], $_SESSION['role'], $_SESSION['username'])) {
            $_SESSION = array();
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            session_destroy();

            header("Location: ../index.php?error=7");
        }
    }

    /**
     * Connect the user
     */
    public function login() {
        $username = filter_var($_POST['loginUsername'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['loginPassword'], FILTER_SANITIZE_STRING);
        $user = UserManager::getManager()->searchUsername($username);

        if($user !== null && password_verify($password, $user->getPassword())) {
            $role = (UserRoleManager::getManager()->searchUser($user->getId()))->getRoleFk()->getId();

            $_SESSION['username'] = $user->getUsername();
            $_SESSION['id'] = $user->getId();
            $_SESSION['role'] = $role;

            header("Location: ../index.php");
        }
        else {
            header("Location: ../index.php?controller=user&error=8");
        }
    }
}