<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Forms\UserForm;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        User::getInstance();
    }

    public function IndexAction()
    {
        $user = User::getById($this->routeParams['id']);
        if ($user) {
            $this->view->render("Пользователь", [
                'user' => $user
            ]);
        } else {
            $this->view->render("Пользователь", [
                'errorFind' => "Нет пользователя с ID: " . $this->routeParams['id']
            ]);
        }
    }

    public function ListAction()
    {
        $this->view->render("Пользователи", [
            'users' => User::getAll()
        ]);
    }

    public function CreateAction()
    {
        $form = new UserForm();
        $createValues = $form->getCreateValues();
        if (!empty($createValues)) {
            if (!empty($form->validateCreateErrors())) {
                $this->view->render("Добавить пользователя", [
                    'errorsValidate' => $form->validateCreateErrors()
                ]);
            } else {
                $createValues['profile-image'] = !empty($_FILES['profile-image']['name']) ?
                    User::uploadProfileImage($_FILES['profile-image']['tmp_name'],
                        $_SERVER['DOCUMENT_ROOT'] . "/upload/") : "/upload/noimage.jpg";
                User::create($createValues);
                $this->view->redirect("/user/list");
            }
        } else {
            $this->view->render("Регистрация");
        }
    }

    public function UpdateAction()
    {
        $form = new UserForm();
        $user = User::getById($this->routeParams['id']);
        $updateValues = $form->getUpdateValues($user);
        if ($user) {
            if (!empty($updateValues)) {
                if (!empty($form->validateUpdateErrors($user))) {
                    $this->view->render("Редактировать пользователя", [
                        'errorsValidate' => $form->validateUpdateErrors($user)
                    ]);
                } else {
                    $updateValues['profile-image'] = !empty($_FILES['profile-image']['name']) ?
                        User::uploadProfileImage($_FILES['profile-image']['tmp_name'],
                            $_SERVER['DOCUMENT_ROOT'] . "/upload/") : "/upload/noimage.jpg";
                    User::update($updateValues);
                    $this->view->redirect("/user/" . $this->routeParams['id']);
                }
            } else {
                $this->view->render("Редактировать пользователя", [
                    'user' => $user
                ]);
            }
        } else {
            $this->view->render("Редактировать пользователя", [
                'errorFind' => "Нет пользователя с ID: " . $this->routeParams['id']
            ]);
        }
    }

    public function DeleteAction()
    {
        $user = User::getById($this->routeParams['id']);
        if ($user) {
            if (isset($_POST['submit'])) {
                User::delete($this->routeParams['id']);
                $this->view->redirect("/user/list");
            } else {
                $this->view->render("Удалить пользователя", [
                    'user' => User::getById($this->routeParams['id'])
                ]);
            }
        } else {
            $this->view->render("Удалить пользователя", [
                'errorFind' => "Нет пользователя с ID: " . $this->routeParams['id']
            ]);
        }
    }
}