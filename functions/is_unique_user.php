<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_users.php";

function is_unique_user(string $path, string $email): bool {
    $users = get_users($path);

    foreach ($users as $user){
        if ($user['email'] == $email){
            echo "Пользователь с Email: '$email' уже существует.";
            return false;
        }
    }

    return true;
}