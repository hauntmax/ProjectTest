<?php

include_once 'functions/getMigrationFiles.php';
include_once 'functions/createVersionsTable.php';
include_once 'functions/insertMigration.php';

createVersionsTable();
if (isset($argv[2])) {
    $classes = get_declared_classes();
    try {
        $migration_name = 'database/migrations/' . $argv[2];
        require_once $migration_name;
        $diff = array_diff(get_declared_classes(), $classes);
        $class = reset($diff);
        $migration = new $class();
        try {
            $migration->up();
            insertMigration(str_replace('database/migrations/', '', $migration_name));
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    } catch (\Exception $ex) {
        die($ex->getMessage());
    }
} else {
    $classes_before_require = get_declared_classes();
    foreach (getMigrationFiles() as $migration_file) {
        require_once 'database/migrations/' . $migration_file;
        $classes_after_require = array_diff(get_declared_classes(), ['App\Core\Schema', 'App\Core\Migration']);
        $diff = array_diff($classes_after_require, $classes_before_require);
        $class = reset($diff);
        $classes_before_require[] = $class;
        $migration = new $class();
        try {
            $migration->up();
            insertMigration(str_replace('database/migrations/', '', $migration_file));
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }
}