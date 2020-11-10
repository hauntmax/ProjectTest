<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_users.php";

function get_user(string $userId): array {
    $users = get_users($_SERVER['DOCUMENT_ROOT']."/userdata");
    return $users[$userId];
}