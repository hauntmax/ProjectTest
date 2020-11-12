<?php

namespace App\Controllers;

use App\Core\Controller;

class MainController extends Controller
{
    public function IndexAction()
    {
        $data = [
            'name' => 'Max',
            'age' => 21
        ];
        $this->view->render('Главная', $data);
    }
}