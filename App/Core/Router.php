<?php

namespace App\Core;


class Router extends Singleton {
    private static array $routes;
    private static array $params;

    protected function __construct()
    {
        parent::__construct();
        $arr = require 'App/Config/routes.php';
        foreach ($arr as $key => $value){
            $this->add($key, $value);
        }
    }

    /**
     * Добавляет маршруты в статическое поле из routes.php
     * @param $route
     * @param $params
     */
    public function add($route, $params)
    {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        self::$routes[$route] = $params;
    }

    /**
     * Сопоставляет маршруты из URI c маршрутами из статической переменной
     * @return bool
     */
    public function match(): bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach (self::$routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int)$match;
                        }
                        $params[$key] = $match;
                    }
                }
                self::$params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Метод предназначен для создания экземпляра класса контроллера
     * и вызова метода действия на основе маршрута
     */
    public function start()
    {
        if ($this->match())
        {
            $path_controller = "App\Controllers\\".ucfirst(self::$params['controller'])."Controller";
            if (class_exists($path_controller))
            {
                $action = ucfirst(self::$params['action']).'Action';
                if (method_exists($path_controller, $action))
                {
                    $controller = new $path_controller(self::$params);
                    $controller->$action();
                }
                else {
                    View::errorCode(404);
                }
            }
            else {
                View::errorCode(404);
            }
        }
        else {
            View::errorCode(404);
        }
    }

//    public static function ErrorPage404() {
//        $host = "http://".$_SERVER['HTTP_HOST'].'/';
//        header('HTTP/1.1 404 Not Found');
//        header("Status: 404 Not Found");
//        header('Location: '.$host.'404');
//    }
}



//    private static string $controller_prefix = "Controller_";
//    private static string $model_prefix = "Model_";
//    private static string $action_prefix = "action_";

//public static function start() {
//    // Имя контроллера и метода действия по-умолчанию
//    $controller_name = "Main";
//    $action_name = "index";
//
//    $path_controller = "App/Controllers";
//
//    // Получить массив имен, разделённых / из URI
//    $routes = explode('/', $_SERVER['REQUEST_URI']);
//
//    // Запись имени контроллера и метода действия из массива
//    if (!empty($routes[0])){
//        $controller_name = $routes[0];
//    }
//    if (!empty($routes[1])){
//        $action_name = $routes[1];
//    }
//
//    // Добавление префиксов
//    $model_name = self::$model_prefix.$controller_name;
//    $controller_name = self::$controller_prefix.$controller_name;
//    $action_name = self::$action_prefix.$action_name;
//
//    // Подключаем файл модели
//    $model_file = strtolower($model_name);
//    $model_path = "App/models/${model_file}.php";
//    if (file_exists($model_path)) {
//        include $model_path;
//    }
//
//    set_include_path($path_controller);
//    spl_autoload($controller_name);
//    spl_autoload_register();
//
//    // Создаём экземпляр контроллера
//    $controller = new $controller_name;
//
//    if (method_exists($controller, $action_name)){
//        $controller->$action_name();
//    }
//    else {
//        die("Контроллер ${controller_name} не содержит действия ${$action_name} !");
//    }
//}