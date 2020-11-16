<?php

namespace App\Controllers;

use App\Core\Controller;

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/string_challenge.php";

class MainController extends Controller
{
    public function IndexAction()
    {
        $this->view->render('Главная');
    }
}