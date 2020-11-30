<?php

require 'App/Lib/Dev.php';
require 'vendor/autoload.php';
require 'App/Lib/registerclass.php';

session_start();
\App\Core\Db::getInstance()->connect();
\App\Core\Router::getInstance()->start();