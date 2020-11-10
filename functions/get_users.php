<?php

function get_users(string $path): array {
    $users = array();
    foreach (glob($path."/*.json") as $jsonFilePath){
        $user = json_decode(file_get_contents($jsonFilePath), true);
        $users[$user['id']] = $user;
    }

    return $users;
}