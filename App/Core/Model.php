<?php


namespace App\Core;


class Model extends Singleton
{
    protected static string $nameDirectory;
    protected static string $dataPath;

    public function __construct()
    {
        parent::__construct();
        self::$dataPath = self::getDataPath(self::$nameDirectory);
    }

    /**
     * @param string $nameDirectory
     * @return string
     */
    public static function getDataPath(string $nameDirectory): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . "/$nameDirectory/";
    }

    /**
     * @param string $id
     * @return false|mixed
     */
    public static function getById(string $id)
    {
        try {
            $data = json_decode(file_get_contents(self::$dataPath . $id . '.json'), true);
            if ($data) {
                return $data;
            }
        } catch (\Exception $exception) {
            die("File " . self::$dataPath . "/$id.json can't be loaded<br>" . $exception);
        }
        return false;
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        $data = [];
        foreach (glob(self::$dataPath . "*.json") as $jsonFilePath) {
            $element = json_decode(file_get_contents($jsonFilePath), true);
            $data[$element['id']] = $element;
        }
        return $data;
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public static function create(array $data)
    {
        if (file_put_contents(self::$dataPath . $data['id'] . ".json",
            json_encode($data))) {
            return $data['id'];
        }
        return false;
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public static function update(array $data)
    {
        if (file_put_contents(self::$dataPath . $data['id'] . ".json", json_encode($data))) {
            return $data['id'];
        }
        return false;
    }

    /**
     * @param string $id
     * @return bool
     */
    public static function delete(string $id)
    {
        $data = self::getById($id);
        if (!$data) {
            return false;
        }
        try {
            unlink(self::$dataPath . $data['id'] . ".json");
            return true;
        } catch (\Exception $ex) {
            die("File " . self::$dataPath . "/$id.json couldn't be deleted<br>" . $ex);
        }
    }
}