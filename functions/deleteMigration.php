<?php

use App\Core\Db;

function deleteMigration($name)
{
    $sql = "DELETE FROM versions WHERE name = :name";
    return Db::getInstance()->query($sql, [
        'name' => $name
    ]);
}