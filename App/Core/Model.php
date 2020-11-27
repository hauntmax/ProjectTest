<?php


namespace App\Core;


class Model
{
    protected static string $tableName;

    /**
     * @param string $id
     * @return false|mixed
     */
    public static function getById(string $id)
    {
        $sql = "SELECT * FROM " . static::$tableName . " WHERE id = :id";
        return Db::getInstance()->queryFetchAssoc($sql, ['id' => $id])[0];
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = "SELECT * FROM " . static::$tableName;
        return Db::getInstance()->queryFetchAssoc($sql);
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public static function create(array $data)
    {

    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function update(array $data)
    {

    }

    /**
     * @param string $id
     * @return mixed
     */
    public static function delete(string $id)
    {
        $sql = "DELETE FROM " . static::$tableName . " WHERE id = :id";
        return Db::getInstance()->query($sql, [
            'id' => $id
        ]);
    }
}