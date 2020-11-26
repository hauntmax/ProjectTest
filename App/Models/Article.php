<?php


namespace App\Models;


use App\Core\Db;
use App\Core\Model;

class Article extends Model
{
    protected static string $tableName = 'articles';

    /**
     * @param string $id
     * @return false|mixed
     */
    public static function getById(string $id)
    {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id = :id";
        return Db::getInstance()->queryFetchAssoc($sql, ['id' => $id])[0];
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = "SELECT * FROM " . self::$tableName;
        return Db::getInstance()->queryFetchAssoc($sql);
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public static function create(array $data)
    {
        $sql = "INSERT INTO " . self::$tableName . "(id,heading,text,user_id)" .
            " VALUES (:id, :heading, :text, :user_id)";
        return Db::getInstance()->query($sql, [
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
        return Db::getInstance()->query($sql, [
            'id' => $data['id'],
            'heading' => $data['heading'],
            'text' => $data['text'],
            'updater_id' => $data['updater_id'],
        ]);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public static function delete(string $id)
    {
        $sql = "DELETE FROM " . self::$tableName . " WHERE id = :id";
        return Db::getInstance()->query($sql, [
            'id' => $id
        ]);
    }
}