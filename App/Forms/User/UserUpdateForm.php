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
                'status_account' => $user['status_account'],
                'password' => !empty($_POST['password']) ?
                    password_hash($_POST['password'], PASSWORD_DEFAULT) :
                    $user['password'],
                'phone' => $this->validator->clean($_POST['phone']),
                'profile_image' => $user['profile_image'],
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