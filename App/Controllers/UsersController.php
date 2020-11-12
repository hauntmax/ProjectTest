<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_users.php";

class UsersController extends Controller
{
    public function IndexAction() {
        $data = [
            'users' => get_users($_SERVER['DOCUMENT_ROOT']."/userdata")
        ];
        if (isset($_SESSION['authorize']))
        {
            if (!$_SESSION['authorize']){
                View::errorCode(401);
            }
        }
        $this->view->render("Пользователи", $data);
    }
}