<?php


namespace App\Core;


class Model extends Singleton
{
    protected static Singleton $db;
    protected static string $tableName;

    public function __construct()
    {
        parent::__construct();
        self::$db = Db::getInstance();
    }

    /**
     * @param string $id
     * @return false|mixed
     */
    public static function getById(string $id)
    {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id = :id";
        return self::$db->queryFetchAssoc($sql, ['id' => $id])[0];
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        $sql = "SELECT * FROM " . self::$tableName;
        return self::$db->queryFetchAssoc($sql);
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
        $sql = "DELETE FROM " . self::$tableName . " WHERE id = :id";
        return self::$db->query($sql, [
            'id' => $id
        ]);
    }
}