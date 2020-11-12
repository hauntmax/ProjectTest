<?php

namespace App\Core;

class Singleton
{
    /**
     * Объект синглтона хранится в статичном поле класса.
     * Поле - массив, так как класс синглтон может иметь подклассы.
     * Все элементы массива будут экземплярами конкретных подклассов синглтона.
     * @var array
     */
    private static $instances = [];

    /**
     * Конструктор Одиночки всегда должен быть скрытым, чтобы предотвратить
     * создание объекта через оператор new.
     */
    protected function __construct() { }

    /**
     * Одиночки не должны быть клонируемыми.
     */
    protected function __clone() { }

    /**
     * Одиночки не должны быть восстанавливаемыми из строк.
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * Статический метод, управляющий доступом к экземпляру синглтона. При
     * первом запуске, он создаёт экземпляр и помещает его в
     * статическое поле. При последующих запусках, он возвращает клиенту объект,
     * хранящийся в статическом поле.
     */
    public static function getInstance(): Singleton
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }
}