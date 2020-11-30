<?php

use App\Core\Db;

function createVersionsTable()
{
    $sql = "CREATE TABLE IF NOT EXISTS versions (
        id int(11) not null primary key auto_increment,
        name varchar(255) not null)";
    return Db::getInstance()->query($sql);
}