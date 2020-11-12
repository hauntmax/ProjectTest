<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_users.php";

function login_user(string $path, array $loginData): bool {
    $users = get_users($path);
    foreach ($users as $user){
        if (($user['email'] == $loginData['email']) &&
            (password_verify($loginData['password'], $user['password']))
        ) {
            $_SESSION['userId'] = $user['id'];
            $_SESSION['authorize'] = true;
            $_SESSION['email'] = $loginData['email'];
            return true;
        }
    }

    return false;
}
