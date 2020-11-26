<?php

require 'App/Lib/Dev.php';
require 'vendor/autoload.php';

use App\Core\Router;
use App\Core\Db;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();
Db::getInstance()->connect();
Router::getInstance()->start();