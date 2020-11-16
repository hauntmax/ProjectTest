<?php


namespace App\Controllers;

use App\Core\Controller;

// Пока нет моделей, использую старые функции
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/get_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/is_unique_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/save_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/delete_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/edit_user.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/upload_profile_image.php";

class UserController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
    }

    public function IndexAction()
    {
        $this->view->render("Пользователь", [
            'user' => get_user($this->route['id'])
        ]);
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
                if (!empty(checkValidateUser($inputUserData)))
                {
                    $this->view->render("Добавление пользователя", [
                        'errorsValidate' => checkValidateUser($inputUserData)
                    ]);
                }
                else {
                    save_user($userDataPath, $inputUserData);
                }
            }
            else {
                $this->view->render("Добавление пользователя", [
                    'errorUnique' => "Пользователь с Email: ".$inputUserData['email']." уже существует."
                ]);
            }
        }
        $this->view->render("Добавление пользователя");
    }

    public function UpdateAction()
    {
        $user = get_user($this->route['id']);
        if(isset($_POST['submit'])) {
            $userDataPath = $_SERVER['DOCUMENT_ROOT']."/userdata";
            $inputUserData = array(
                'id' => $this->route['id'],
                'name' => clean($_POST['name']),
                'email' => clean($_POST['email']),
                'password' => clean($_POST['password']),
                'phone' => clean($_POST['phone']),
                'profile-image' => !empty($_FILES['profile-image']['name']) ?
                    upload_profile_image($_FILES['profile-image']['tmp_name'],
                        $_SERVER['DOCUMENT_ROOT'] . "/upload/") : "/upload/noimage.jpg"
            );
            if (!empty(checkValidateUser($inputUserData)))
            {
                $this->view->render("Редактировать пользователя", [
                    'errorsValidate' => checkValidateUser($inputUserData)
                ]);
            }
            else {
                edit_user($userDataPath, $this->route['id'], $inputUserData);
            }
        }
        $this->view->render("Редактировать пользователя", [
            'user' => $user
        ]);
    }

    public function DeleteAction()
    {
        if(isset($_POST['submit'])) {
            delete_user($this->route['id']);
            $this->view->redirect("/users");
        }
        $this->view->render("Удалить пользователя", [
            'user' => get_user($this->route['id'])
        ]);
    }
}

//isset($user['profile-image']) ?
//    upload_profile_image($_FILES['profile-image']['tmp_name'],
//        $_SERVER['DOCUMENT_ROOT'] . "/upload/") : $user['profile-image']