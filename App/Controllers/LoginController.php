<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Forms\User\UserLoginForm;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        User::getInstance();
    }

    public function IndexAction()
    {
        $form = new UserLoginForm();
        if (!$form->getValues()) {
            $this->view->render("Вход");
        }
        if (!$this->LoginUser($form->getValues())) {
            $this->view->render("Вход", [
                'errorLogin' => "Введены неверные данные или аккаунт не активирован"
            ]);
        } else {
            $this->view->redirect("/user/" . $_SESSION['userId']);
        }
    }

    public function LogoutAction()
    {
        session_start();
        session_destroy();
        header('Location:/');
    }

    public function LoginUser(array $loginData)
    {
        $users = User::getAll();
        foreach ($users as $user) {
            if (($user['email'] == $loginData['email']) &&
                (password_verify($loginData['password'], $user['password']))) {
                if ($user['status-account'] === false) {
                    return false;
                } else {
                    $_SESSION['userId'] = $user['id'];
                    $_SESSION['email'] = $loginData['email'];
                    $_SESSION['authorize-token'] = $user['token'];
                    $_SESSION['isAuthorize'] = true;
                    return true;
                }
            }
        }
        return false;
    }
}