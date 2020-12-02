<?php


namespace App\Models;

use App\Core\Db;
use App\Core\Model;

class Article extends Model
{
    /**
     * @var string
     */
    protected static string $tableName = 'articles';

    /**
     * @return string
     */
    private static function selectQueryWithUserInfo()
    {
        return "SELECT articles.id as id,user_id,users.email as user_email,users.name as user_name,
                       users.phone as user_phone,heading,text,updater_id,creation_date,updating_date
                FROM articles JOIN users ON " . self::$tableName . ".user_id = users.id ";
    }

    /**
     * @return mixed
     */
    public static function getAllWithUserInfo()
    {
        $sql = self::selectQueryWithUserInfo();
        return Db::getInstance()->queryFetchAssoc($sql);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public static function getByIdWithUserInfo(string $id)
    {
        $sql = self::selectQueryWithUserInfo() . "WHERE articles.id = :id";
        $result = Db::getInstance()->queryFetchAssoc($sql, [
            'id' => $id
        ]);
        return reset($result);
    }

    /**
     * @param string $user_id
     * @return mixed
     */
    public static function getAllByUserId(string $user_id)
    {
        $sql = self::selectQueryWithUserInfo() . "WHERE users.id = :user_id";
        return Db::getInstance()->queryFetchAssoc($sql, [
            'user_id' => $user_id
        ]);
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
}