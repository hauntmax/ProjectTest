#!/usr/bin/php
<?php

require 'App/Lib/registerclass.php';
\App\Core\Db::getInstance()->connect();
$commands = require __DIR__ . '/commands/list.php';


if (in_array($argv[1], array('help', '--help', '-help', '-h', '-?'))) {
    echo PHP_EOL . "Script '$argv[0]' contains this commands" . PHP_EOL;
    foreach ($commands as $command => $description) {
        echo $command . " -> " . $description . PHP_EOL;
    }
    echo PHP_EOL;
} else if (key_exists($argv[1], $commands)) {
    require_once __DIR__ . "/commands/" . $argv[1] . ".php";
} else {
    die("Unknown command '$argv[1]'" . PHP_EOL);
}