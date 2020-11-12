<?php


namespace App\Core;


class View
{
    public string $path;
    public array $route;
    public string $layout = 'default';

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->path = ucfirst($route['controller']).'/'.$route['action'];
    }

    public function render(string $title, array $data = [])
    {
        extract($data);
        if (file_exists('App/Views/'.$this->path.'.php')){
            ob_start();
            require 'App/Views/'.$this->path.'.php';
            $content = ob_get_clean();
            require 'App/Views/Layouts/'.$this->layout.'.php';
        }
        else {
            die('Предcтавление '.$this->path.'.php не найдено');
        }
    }
}