<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/validate_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/login_user.php";

function save_user(string $path ,array $userData){
    if (validate_user($userData)){
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        if (file_put_contents($path.'/'.$userData['id'].".json", json_encode($userData))){
            header("Location: "."/users");
        }
    }
}