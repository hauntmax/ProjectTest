<?php

use App\Core\Db;

function getMigrationFiles() {
    // Получаю имена файлов миграций, отрезая 'database/migrations/'
    $allFiles = array_map(function ($file) {
        return str_replace('database/migrations/', '', $file);
    }, glob('database/migrations/*.php'));

    // Получаю список имен миграций из таблицы БД
    // Если нет миграций то возвращаю все файлы
    $sql = "select name from versions";
    $versions = Db::getInstance()->queryFetchAssoc($sql);
    if (!$versions) {
        echo "First Migration" . PHP_EOL;
        return $allFiles;
    }

    // Прохожусь по всем найденным миграциям из БД
    // Добавляю те, которые есть в списке всех файлов
    $versionFiles = [];
    foreach ($versions as $file) {
        if (in_array($file['name'], $allFiles)) {
            array_push($versionFiles, $file['name']);
        }
    }

    // Возвращаю (Все - Те, которые в БД)
    return array_diff($allFiles, $versionFiles);
}