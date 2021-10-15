<?php

use App\Controller\HomeController;

session_start();

require_once "vendor/autoload.php";

if(isset($_GET['controller'])) {
    $class = ucfirst(filter_var($_GET['controller'], FILTER_SANITIZE_STRING)) . "Controller";

    if(class_exists('App\\Controller\\' . $class)) {
        $class = 'App\\Controller\\' . $class;
        $controller = new $class();
        if(isset($_GET['action'])) {
            try {
                if((new ReflectionClass($class))->hasMethod(filter_var($_GET['action'], FILTER_SANITIZE_STRING))){
                    $method = filter_var($_GET['action'], FILTER_SANITIZE_STRING);
                    $controller->$method();
                }
                else {
                    $controller->homePage();
                }
            }
            catch (ReflectionException $reflectionException) {
                echo $reflectionException->getMessage();
            }
        }
        else {
            $controller->homePage();
        }
    }
    else {
        (new HomeController())->homePage();
    }
}
else {
    (new HomeController())->homePage();
}