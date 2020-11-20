<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Validators\UserValidator;


class LoginController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->model = new User();
        $this->validator = new UserValidator();
    }

    public function IndexAction()
    {
        if (isset($_POST['submit'])) {
            $loginData = array(
                'email' => $this->validator->clean($_POST['email']),
                'password' => $this->validator->clean($_POST['password'])
            );

            if ($this->LoginUser($loginData)) {
                $this->view->redirect("/users");
            } else {
                $this->view->render("Вход", [
                    'errorLogin' => "Введены неверные данные или аккаунт не активирован"
                ]);
            }
        }

        $this->view->render("Вход");
    }

    public function LoginUser(array $loginData)
    {
        $users = $this->model->getAll();
        foreach ($users as $user) {
            if (($user['email'] == $loginData['email']) &&
                (password_verify($loginData['password'], $user['password']))) {
                if ($user['status-account'] === false) {
                    return false;
                } else {
                    $_SESSION['userId'] = $user['id'];
                    $_SESSION['email'] = $loginData['email'];
                    $_SESSION['authorize'] = true;
                    return true;
                }
            }
        }
        return false;
    }
}