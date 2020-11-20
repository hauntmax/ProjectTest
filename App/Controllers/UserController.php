<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Validators\UserValidator;

include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/upload_profile_image.php";

class UserController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->model = new User();
        $this->validator = new UserValidator();
    }

    public function IndexAction()
    {
        $user = $this->model->getById($this->route['id']);
        if ($user) {
            $this->view->render("Пользователь", [
                'user' => $user
            ]);
        } else {
            $this->view->render("Пользователь", [
                'errorFind' => "Нет пользователя с ID: " . $this->route['id']
            ]);
        }
    }

    public function CreateAction()
    {
        if (isset($_POST['submit'])) {
            $inputUserData = array(
                'id' => uniqid(),
                'name' => $this->validator->clean($_POST['name']),
                'email' => $this->validator->clean($_POST['email']),
                //'status-email' => isConfirmedEmail(),
                'password' => $this->validator->clean($_POST['password']),
                'phone' => $this->validator->clean($_POST['phone']),
                'profile-image' => !empty($_FILES['profile-image']['name']) ?
                    upload_profile_image($_FILES['profile-image']['tmp_name'],
                        $_SERVER['DOCUMENT_ROOT'] . "/upload/") : "/upload/noimage.jpg"
            );
            if ($this->model->isUniqueUser($inputUserData['email'])) {
                $errorsValidate = $this->validator->Validate($inputUserData);
                if (!empty($errorsValidate)) {
                    $this->view->render("Регистрация", [
                        'errorsValidate' => $errorsValidate
                    ]);
                } else {
                    $this->model->create($inputUserData);
                    $this->view->redirect("/users");
                }
            } else {
                $this->view->render("Регистрация", [
                    'errorUnique' => "Пользователь с Email: " . $inputUserData['email'] . " уже существует."
                ]);
            }
        } else {
            $this->view->render("Регистрация");
        }
    }

    public function UpdateAction()
    {
        $user = $this->model->getById($this->route['id']);
        if ($user) {
            if (isset($_POST['submit'])) {
                $inputUserData = array(
                    'id' => $this->route['id'],
                    'name' => $this->validator->clean($_POST['name']),
                    'email' => $this->validator->clean($_POST['email']),
                    'status-account' => $user['status-account'],
                    'password' => !empty($_POST['password']) ?
                        password_hash($this->validator->clean($_POST['password']), PASSWORD_DEFAULT) :
                        $user['password'],
                    'phone' => $this->validator->clean($_POST['phone']),
                    'profile-image' => !empty($_FILES['profile-image']['name']) ?
                        upload_profile_image($_FILES['profile-image']['tmp_name'],
                            $_SERVER['DOCUMENT_ROOT'] . "/upload/") : "/upload/noimage.jpg"
                );
                $errorsValidate = $this->validator->Validate($inputUserData);
                if (!empty($errorsValidate)) {
                    $this->view->render("Редактировать пользователя", [
                        'errorsValidate' => $errorsValidate
                    ]);
                } else {
                    $this->model->update($inputUserData);
                    $this->view->redirect("/user/" . $this->route['id']);
                }
            } else {
                $this->view->render("Редактировать пользователя", [
                    'user' => $user
                ]);
            }
        } else {
            $this->view->render("Редактировать пользователя", [
                'errorFind' => "Нет пользователя с ID: " . $this->route['id']
            ]);
        }
    }

    public function DeleteAction()
    {
        $user = $this->model->getById($this->route['id']);
        if ($user) {
            if (isset($_POST['submit'])) {
                $this->model->delete($this->route['id']);
                $this->view->redirect("/users");
            } else {
                $this->view->render("Удалить пользователя", [
                    'user' => $this->model->getById($this->route['id'])
                ]);
            }
        } else {
            $this->view->render("Удалить пользователя", [
                'errorFind' => "Нет пользователя с ID: " . $this->route['id']
            ]);
        }
    }
}