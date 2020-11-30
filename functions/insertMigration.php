<?php

use App\Core\Db;

function insertMigration($name)
{
    $sql = "INSERT INTO versions (name) VALUES (:name)";
    return Db::getInstance()->query($sql, [
        'name' => $name
    ]);
}