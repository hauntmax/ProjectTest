<?php


namespace App\Forms;


use App\FormBuilder\Form;
use App\Models\User;
use App\Models\Validators\UserValidator;

class UserForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new UserValidator();
    }

    public function getCreateValues(): array
    {
        if (isset($_POST['submit'])) {
            return array(
                'id' => uniqid(),
                'name' => $this->validator->clean($_POST['name']),
                'email' => $this->validator->clean($_POST['email']),
                'status-account' => false,
                'password' => $this->validator->clean($_POST['password']),
                'phone' => $this->validator->clean($_POST['phone']),
            );
        }
        return [];
    }

    public function getUpdateValues($user): array
    {
        if (isset($_POST['submit'])){
            return array(
                'id' => $user['id'],
                'name' => $this->validator->clean($_POST['name']),
                'email' => $this->validator->clean($_POST['email']),
                'status-account' => $user['status-account'],
                'password' => !empty($_POST['password']) ?
                    password_hash($this->validator->clean($_POST['password']), PASSWORD_DEFAULT) :
                    $user['password'],
                'phone' => $this->validator->clean($_POST['phone']),
            );
        }
        return [];
    }

    public function getLoginValues()
    {
        if (isset($_POST['submit'])) {
            return array(
                'email' => $this->validator->clean($_POST['email']),
                'password' => $this->validator->clean($_POST['password'])
            );
        }
        return [];
    }

    public function validateCreateErrors(): array
    {
        $errors = $this->validator->Validate($this->getCreateValues());
        if (isset($this->getCreateValues()['email']) && !User::isUniqueUser($this->getCreateValues()['email'])) {
            $errors['unique_user'] = "Пользователь с Email: " . $this->getCreateValues()['email'] . " уже существует.";
        }
        return $errors;
    }

    public function validateUpdateErrors($user): array
    {
        return $this->validator->Validate($this->getUpdateValues($user));
    }
}