<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_users.php";

function delete_user(string $userId) {
    $user = get_user($userId);
    unlink($_SERVER['DOCUMENT_ROOT']."/userdata/".$user['id'].".json");
    if ($userId == $_SESSION['userId']){
        session_start();
        session_destroy();
        header('Location:/');
    }
}