<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/validate_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/delete_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/save_user.php";

function edit_user(string $path, string $userId, array $userData) {
    delete_user($userId);
    save_user($path, $userData);
}