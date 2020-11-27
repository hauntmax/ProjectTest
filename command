#!/usr/bin/php
<?php

$commands = [
    'make_migration' => 'Makes migration by name parameter',
    'migrate' => 'Execute migrations'
];

if (in_array($argv[1], array('help', '--help', '-help', '-h', '-?'))) {
    print(PHP_EOL . "Script '$argv[0]' contains this commands") . PHP_EOL;
    foreach ($commands as $command => $description) {
        print($command) . " -> " . $description . PHP_EOL;
    }
    print PHP_EOL;
?>
<?php } else if (key_exists($argv[1], $commands)) {
    require_once __DIR__ . "/commands/" . $argv[1] . ".php";
} else {
    echo "Unknown command '$argv[1]'" . PHP_EOL;
}