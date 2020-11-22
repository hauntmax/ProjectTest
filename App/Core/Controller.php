<?php


namespace App\Core;


use App\Models\Validators\Validator;

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