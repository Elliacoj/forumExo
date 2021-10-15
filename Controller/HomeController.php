<?php

namespace App\Controller;

use App\Controller\Traits\RenderController;
use App\Model\Manager\UserManager;

class HomeController {
    use RenderController;

    /**
     * Redirects into home page
     */
    public function homePage() {
        $this->render("accueil", "Accueil");
    }

    /**
     * Redirects into profile page
     */
    public function profile() {
        $user = UserManager::getManager()->search($_SESSION['id']);
        $this->render("profile", "Votre profil", ["user" => $user]);
    }

    /**
     * Redirects into administration page
     */
    public function administration() {
        $this->render("administration", "Panel d'administration");
    }

    /**
     * Redirects into category page
     */
    public function redirectCategory() {
        $category = filter_var($_GET['category'], FILTER_SANITIZE_STRING);
        $this->render("category", "Catégorie " . $category);
    }

    /**
     * Redirects into regulation page
     */
    public function regulation() {
        $this->render("regulation", "Réglement");
    }

    /**
     * Redirects into monolog page
     */
    public function monologPage() {
        $this->render("monolog", "Monolog");
    }

    /**
     * Redirects into paypal page
     */
    public function paypalPage() {
        $this->render("paypal.page", "Monolog");
    }
}