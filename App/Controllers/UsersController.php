<?php


namespace App\Controllers;

use App\Core\Controller;

class UsersController extends Controller
{
    public function IndexAction() {
        $this->view->render("Пользователи");
    }
}