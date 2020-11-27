<?php

include_once $_SERVER['DOCUMENT_ROOT'] . 'functions/dashesToCamelCase.php';

if (!isset($argv[2])) {
    die("Migration name is not set" . PHP_EOL);
}

$className = dashesToCamelCase($argv[2]);

$class_text = <<<EOT
<?php

use App\Core\Migration;

class $className extends Migration
{
    public function up() {}
    
    public function down() {}
}
EOT;

//Y_m_d_His
$path_migrations = $_SERVER['DOCUMENT_ROOT'] . "database/migrations/";
$name_migration = date("Y_m_d_His") . "_" . $argv[2] . ".php";

$fp = fopen($path_migrations . $name_migration, "w");
if (fwrite($fp, $class_text)) {
    echo "Migration $name_migration created!" . PHP_EOL;
    fclose($fp);
} else {
    die("Error writing to file $name_migration");
}