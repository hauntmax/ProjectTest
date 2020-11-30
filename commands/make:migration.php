<?php

include_once 'functions/dashesToCamelCase.php';

if (!isset($argv[2])) {
    die("Migration name is not set" . PHP_EOL);
}

$class_name = dashesToCamelCase($argv[2]);
$operation = isset($argv[3]) ? $argv[3] : 'create';
$table_name = isset($argv[4]) ? $argv[4] : 'tableName';

$class_text = <<<EOT
<?php

use App\Core\Schema;
use App\Core\Migration;

class $class_name extends Migration
{
    /**
     * Запуск миграций
     * Нужно вызвать метод класса Schema
     * Schema::operation('create', 'tableName', [
     *     'id int(11) not null primary key auto_increment',
     * ]));
     *
     * @return void
     */
    public function up() 
    {
        Schema::operation('$operation', '$table_name', [
            
        ]);
    }
    
    /**
     * Отменяет миграцию
     *
     * @return void
     */
    public function down() 
    {
        Schema::operation('drop', '$table_name');
    }
}
EOT;

$path_migrations = $_SERVER['DOCUMENT_ROOT'] . "database/migrations/";
$name_migration = date("Y_m_d_His") . "_" . $argv[2] . ".php";

$fp = fopen($path_migrations . $name_migration, "w");
if (fwrite($fp, $class_text)) {
    echo "Migration $name_migration created!" . PHP_EOL;
    fclose($fp);
} else {
    die("Error writing to file $name_migration");
}