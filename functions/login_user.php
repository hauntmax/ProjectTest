<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_users.php";

function login_user(string $path, array $loginData): bool {
    $isRegistered = false;
    $users = get_users($path);
    foreach ($users as $user){
        if (($user['email'] == $loginData['email']) &&
            (password_verify($loginData['password'], $user['password']))
        ) {
            $isRegistered = true;
            $_SESSION['userId'] = $user['id'];
            break;
        }
    }

    if ($isRegistered) {
        $_SESSION['authorize'] = true;
        $_SESSION['email'] = $loginData['email'];
        $_SESSION['password'] = password_hash($loginData['password'], PASSWORD_DEFAULT);
    }

    return $isRegistered;
}
