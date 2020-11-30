<?php


namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Db extends Singleton
{
    /**
     * Свойство для подключения и выполнения запросов к БД
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * Метод для инициализации PDO объекта
     *
     * @return void
     */
    public function connect()
    {
        $config = require 'App/Config/db.php';
        try {
            $this->pdo = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
                $config['user'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $ex) {
            die("Подключение на удалось: " . $ex->getMessage() . PHP_EOL);
        }
    }

    /**
     * Метод подготавливает и выполняет запрос
     *
     * @param string $sql
     * @param array $params
     * @return PDOStatement
     */
    public function query(string $sql, array $params = []): PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $statement->bindValue(':' . $param, $value);
            }
        }
        $statement->execute();
        return $statement;
    }

    /**
     * Метод для получения массива из результата выборки из БД
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function queryFetchAssoc(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
//    public function queryFetchColumn(string $sql, array $params = [])
//    {
//        return $this->query($sql, $params)->fetchColumn(PDO::FETCH_COLUMN);
//    }
}