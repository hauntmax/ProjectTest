<?php

namespace App\Controllers;

use App\Core\Controller;


class MainController extends Controller
{
    public function IndexAction()
    {
        $this->view->render('Главная');
    }
}