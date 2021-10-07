<?php


namespace App\Controller;


use App\Controller\Traits\RenderController;

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

    public function create() {
        $username =
    }
}