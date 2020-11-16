<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_users.php";

function delete_user(string $userId) {
    $user = get_user($userId);
    if ($user['profile-image'] !== "/upload/noimage.jpg"){
        unlink($_SERVER['DOCUMENT_ROOT'] . $user['profile-image']);
    }
    unlink($_SERVER['DOCUMENT_ROOT'] . "/userdata/" . $user['id'] . ".json");
    if ($user['id'] == $_SESSION['userId']){
        session_start();
        session_destroy();
        header('Location:/');
    }
}