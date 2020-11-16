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

}