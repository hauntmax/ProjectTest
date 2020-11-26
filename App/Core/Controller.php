<?php


namespace App\Core;


abstract class Controller
{
    protected array $routeParams;
    protected View $view;

    public function __construct()
    {
        $this->routeParams = Router::getInstance()->getParams();
        $this->view = new View();
    }
}