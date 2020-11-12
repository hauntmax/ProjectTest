<?php


namespace App\Controllers;

use App\Core\Controller;

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/login_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/validate_user.php";

class LoginController extends Controller
{
    public function IndexAction()
    {
        if(isset($_POST['submit'])) {
            $loginData = array(
                'email' => clean($_POST['email']),
                'password' => clean($_POST['password'])
            );

            if (login_user($_SERVER['DOCUMENT_ROOT']."/userdata", $loginData)){
                $this->view->redirect("/users");
            } else {
                $this->view->render("Вход", [
                    'errorLogin' => "Введены неверные логин или пароль"
                ]);
            }
        }

        $this->view->render("Вход");
    }
}