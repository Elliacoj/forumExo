<?php

use App\Model\Manager\RoleManager;
use App\Model\Manager\UserManager;
use App\Model\Manager\UserRoleManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

header('Content-Type: application/json');
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {
    case "GET":
        echo getUserRole();
        break;
    case "PUT":
        updateUserRole(json_decode(file_get_contents('php://input')));
        break;
    case "DELETE":
        banUser(json_decode(file_get_contents('php://input')));
        break;
}

/**
 * Return all user and role
 * @return false|string
 */
function getUserRole() {
    $users = UserManager::getManager()->get();
    $roles = RoleManager::getManager()->get();

    $allUserRole = ["user" => [], "role" => []];

    foreach($users as $user) {
        $userRole = UserRoleManager::getManager()->searchUser($user->getId());
        $allUserRole["user"][] = [
            "username" => $user->getUsername(), "id" => $user->getId(), "role" => $userRole->getRoleFk()->getId(),
            "ban" => $user->getActivated()
        ];
    }

    foreach($roles as $role) {
        $allUserRole["role"][] = ["name" => $role->getName(), "id" => $role->getId()];
    }
    return json_encode($allUserRole);
}

/**
 * Update a role of user into userRole table
 * @param $data
 */
function updateUserRole($data) {
    $role = RoleManager::getManager()->search($data->role);
    $userRole = UserRoleManager::getManager()->searchUser($data->idUser);
    $userRole->setRoleFk($role);

    if($_SESSION['role'] === 2) {
        $log = new Logger('LogAdmin');
        $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
        $log->info("Le modérateur " . $_SESSION['username'] . " a mise à jour le role de \"" .
            $userRole->getUserFk()->getUsername() . "\"");
    }

    UserRoleManager::getManager()->update($userRole);
}

/**
 * Update an user activated into user table
 * @param $data
 */
function banUser($data) {
    $user = UserManager::getManager()->search($data->id);
    $user->setActivated($data->ban);
    if($_SESSION['role'] === 2) {
        $log = new Logger('LogAdmin');
        $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/log.txt', Logger::INFO));
        $log->info("Le modérateur " . $_SESSION['username'] . " a banni/débanni l'utilisateur \"" .
            $user->getUsername() . "\"");
    }
    UserManager::getManager()->updateActivated($user);
}
