<?php


namespace App\Controllers;

use App\Core\Controller;

// Пока нет моделей, использую старые функции
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/is_unique_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/save_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/delete_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/edit_user.php";

class UserController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
    }

    public function IndexAction()
    {
        $data = [
            'user' => get_user($this->route['id'])
        ];
        $this->view->render("Пользователь", $data);
    }

    public function CreateAction()
    {
        if(isset($_POST['submit'])) {
            $userDataPath = $_SERVER['DOCUMENT_ROOT']."/userdata";
            $inputUserData = array(
                'id' => uniqid(),
                'name' => clean($_POST['name']),
                'email' => clean($_POST['email']),
                'password' => clean($_POST['password']),
                'phone' => clean($_POST['phone'])
            );
            if (is_unique_user($userDataPath, $inputUserData['email'])) {
                save_user($userDataPath, $inputUserData);
            }
        }
        $this->view->render("Создать пользователя");
    }

    public function UpdateAction()
    {
        $data = [
            'user' => get_user($this->route['id'])
        ];
        if(isset($_POST['submit'])) {
            $userDataPath = $_SERVER['DOCUMENT_ROOT']."/userdata";
            $inputUserData = array(
                'id' => $data['user']['id'],
                'name' => clean($_POST['name']),
                'email' => clean($_POST['email']),
                'password' => clean($_POST['password']),
                'phone' => clean($_POST['phone'])
            );
            edit_user($userDataPath, $data['user']['id'], $inputUserData);
        }
        $this->view->render("Редактировать пользователя", $data);
    }

    public function DeleteAction()
    {
        $data = [
            'user' => get_user($this->route['id'])
        ];
        if(isset($_POST['submit'])) {
            delete_user($data['user']['id']);
            $this->view->redirect("/users");
        }
        $this->view->render("Удалить пользователя", $data);
    }
}