<?php


namespace App\Core;


class Schema
{
    /**
     * Выполняет операцию с таблицами БД
     *
     * @param string $operation_name
     * @param string $table_name
     * @param array $attrs
     */
    public static function operation(string $operation_name, string $table_name, array $attrs = [])
    {
        if ($operation_name !== 'drop' && empty($attrs)) {
            die("Params of $operation_name table $table_name is empty" . PHP_EOL);
        }
        switch ($operation_name) {
            case 'create' :
            {
                $sql = "$operation_name TABLE IF NOT EXISTS $table_name (";
                $count = count($attrs);
                foreach ($attrs as $attr) {
                    if (--$count <= 0) {
                        $sql .= $attr . PHP_EOL;
                    } else {
                        $sql .= $attr . ',' . PHP_EOL;
                    }
                }
                $sql .= ");";
                break;
            }
            case 'alter' :
            {
                $sql = "$operation_name TABLE $table_name ";
                $count = count($attrs);
                foreach ($attrs as $attr) {
                    if (--$count <= 0) {
                        $sql .= $attr . PHP_EOL;
                    } else {
                        $sql .= $attr . ',' . PHP_EOL;
                    }
                }
                break;
            }
            case 'drop' :
            {
                $sql = "$operation_name TABLE IF EXISTS $table_name";
                break;
            }
        }
        try {
            Db::getInstance()->query($sql);
            echo "Table '$table_name' was $operation_name successfully" . PHP_EOL;
        } catch (\PDOException $ex) {
            die("An error occurred while $operation_name the table '$table_name'" . PHP_EOL . $ex->getMessage() . PHP_EOL);
        }
    }
}