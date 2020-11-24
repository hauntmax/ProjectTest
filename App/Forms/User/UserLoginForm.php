<?php


namespace App\Forms\User;

use App\Forms\Form;
use App\Forms\Validators\UserValidator;

class UserLoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new UserValidator();
    }

    public function getValues(array $data = null): array
    {
        if ($this->isSubmit()) {
            return array(
                'email' => $this->validator->clean($_POST['email']),
                'password' => $this->validator->clean($_POST['password'])
            );
        }
        return [];
    }
}