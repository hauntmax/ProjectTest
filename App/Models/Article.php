<?php


namespace App\Models;


use App\Core\Model;

class Article extends Model
{
    public function __construct()
    {
        self::$nameDirectory = 'articles';
        parent::__construct();
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        return parent::getAll();
    }

    /**
     * @param string $id
     * @return false|mixed|void
     */
    public static function getById(string $id)
    {
        return parent::getById($id);
    }

    /**
     * @param array $article
     * @return int
     */
    public static function create(array $article)
    {
        return parent::create($article);
    }

    /**
     * @param array $data
     * @return false|mixed
     */
    public static function update(array $data)
    {
        return parent::update($data);
    }

    /**
     * @param string $id
     * @return bool
     */
    public static function delete(string $id)
    {
        return parent::delete($id);
    }
}