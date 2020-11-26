<?php


namespace App\Models;


use App\Core\Model;

class Article extends Model
{
    public function __construct()
    {
        self::$tableName = 'articles';
        parent::__construct();
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public static function create(array $data)
    {
        $sql = "INSERT INTO " . self::$tableName . "(id,heading,text,user_id)" .
            " VALUES (:id, :heading, :text, :user_id)";
        return self::$db->query($sql, [
            'id' => $data['id'],
            'heading' => $data['heading'],
            'text' => $data['text'],
            'user_id' => $data['user_id'],
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function update(array $data)
    {
        $sql = "UPDATE " . self::$tableName .
            " SET heading = :heading, text = :text, updater_id = :updater_id
               WHERE id = :id";
        return self::$db->query($sql, [
            'id' => isset($data['id']) ? $data['id'] : "",
            'heading' => isset($data['heading']) ? $data['heading'] : "",
            'text' => isset($data['text']) ? $data['text'] : "",
            'updater_id' => isset($data['updater_id']) ? $data['updater_id'] : "",
        ]);
    }
}