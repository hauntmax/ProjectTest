<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;


class UsersController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->model = new User();
    }

    public function IndexAction() {
        $this->view->render("Пользователи", [
            'users' => $this->model->getAll()
        ]);
    }
}