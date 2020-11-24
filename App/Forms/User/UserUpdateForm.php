<?php


namespace App\Forms\User;

use App\Forms\Validators\UserValidator;

class UserUpdateForm extends UserCreateForm
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new UserValidator();
    }

    public function getValues(array $user = null): array
    {
        if ($this->isSubmit()) {
            return [
                'id' => $user['id'],
                'name' => $this->validator->clean($_POST['name']),
                'email' => $this->validator->clean($_POST['email']),
                'status-account' => $user['status-account'],
                'password' => !empty($_POST['password']) ?
                    password_hash($this->validator->clean($_POST['password']), PASSWORD_DEFAULT) :
                    $user['password'],
                'phone' => $this->validator->clean($_POST['phone']),
                'profile-image' => "/upload/noimage.jpg",
                'token' => $user['token']
            ];
        }
        return [];
    }

    public function validateErrors(array $user = null): array
    {
        return $this->validator->Validate($this->getValues($user));
    }
}