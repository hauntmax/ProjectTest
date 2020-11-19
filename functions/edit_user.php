<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/validate_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/delete_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/save_user.php";

function edit_user(string $path, array $userData) {
    delete_user($userData['id']);
    if (file_put_contents($path.'/'.$userData['id'].".json", json_encode($userData))){
        header("Location: "."/users");
    }
}