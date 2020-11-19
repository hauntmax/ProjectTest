<?php


namespace App\Core;


use App\Models\Validators\Validator;

abstract class Controller
{
    public array $route;
    public View $view;
    public Model $model;
    public Validator $validator;

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }
}