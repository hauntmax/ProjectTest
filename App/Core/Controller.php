<?php


namespace App\Core;


abstract class Controller
{
    public array $route;
    public View $view;

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }
}