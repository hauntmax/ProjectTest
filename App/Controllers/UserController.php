<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Forms\User\UserCreateForm;
use App\Forms\User\UserDeleteForm;
use App\Forms\User\UserUpdateForm;
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
        $form = new UserCreateForm();
        $createValues = $form->getValues();
        if (empty($createValues)) {
            $this->view->render("Добавить пользователя");
        }
        if (!empty($form->validateErrors())) {
            $this->view->render("Добавить пользователя", [
                'errorsValidate' => $form->validateErrors()
            ]);
        } else {
            if ($form->isUploadProfileImage()) {
                $createValues['profile-image'] = User::uploadProfileImage($form->getImageTmpName());
            }
            User::create($createValues);
            $this->view->redirect("/user/list");
        }
    }

    public function UpdateAction()
    {
        $form = new UserUpdateForm();
        $user = User::getById($this->routeParams['id']);
        if (!$user) {
            $this->view->render("Редактировать пользователя", [
                'errorFind' => "Нет пользователя с ID: " . $this->routeParams['id']
            ]);
        }
        $updateValues = $form->getValues($user);
        if (empty($updateValues)) {
            $this->view->render("Редактировать пользователя", [
                'user' => $user
            ]);
        }
        if (!empty($form->validateErrors($user))) {
            $this->view->render("Редактировать пользователя", [
                'errorsValidate' => $form->validateErrors($user)
            ]);
        } else {
            if ($form->isUploadProfileImage()) {
                $updateValues['profile-image'] = User::uploadProfileImage($form->getImageTmpName());
            }
            User::update($updateValues);
            $this->view->redirect("/user/" . $this->routeParams['id']);
        }
    }

    public function DeleteAction()
    {
        $form = new UserDeleteForm();
        $user = User::getById($this->routeParams['id']);
        if (!$user) {
            $this->view->render("Удалить пользователя", [
                'errorFind' => "Нет пользователя с ID: " . $this->routeParams['id']
            ]);
        }
        if (!$form->isSubmit()) {
            $this->view->render("Удалить пользователя", [
                'user' => User::getById($this->routeParams['id'])
            ]);
        } else {
            User::delete($this->routeParams['id']);
            $this->view->redirect("/user/list");
        }
    }
}