<?php

use App\Controller\HomeController;

session_start();

require_once "vendor/autoload.php";

if(isset($_GET['controller'])) {

}
else {
    (new HomeController())->homePage();
}