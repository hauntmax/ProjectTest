<?php

include_once 'functions/getMigrationFiles.php';
include_once 'functions/deleteMigration.php';

$classes = get_declared_classes();
$migration_files = glob('database/migrations/*.php');

$count = count($migration_files);
foreach ($migration_files as $migration_file) {
    if (--$count <= 0) {
        require_once $migration_file;
        $diff = array_diff(get_declared_classes(), $classes);
        $class = reset($diff);
        $classes[] = $class;
        $migration = new $class();
        try {
            $migration->down();
            //unlink($migration_file);
            deleteMigration(str_replace('database/migrations/', '', $migration_file));
        } catch (\PDOException $ex) {
            die($ex->getMessage());
        }
    }
}