<?php

namespace App\Controller;

use App\Controller\Traits\RenderController;

class HomeController {
    use RenderController;

    /**
     * Redirects into accueil page
     */
    public function homePage() {
        $this->render("accueil", "Accueil");
    }
}