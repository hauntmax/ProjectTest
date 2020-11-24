<?php


namespace App\Forms\User;

use App\Forms\Form;
use App\Models\User;
use App\Forms\Validators\UserValidator;

class UserCreateForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new UserValidator();
    }

    public function getImageName()
    {
        return $_FILES['profile-image']['name'];
    }

    public function getImageTmpName()
    {
        return $_FILES['profile-image']['tmp_name'];
    }

    public function getValues(array $data = null): array
    {
        if ($this->isSubmit()) {
            return [
                'id' => uniqid(),
                'name' => $this->validator->clean($_POST['name']),
                'email' => $this->validator->clean($_POST['email']),
                'status-account' => false,
                'password' => $this->validator->clean($_POST['password']),
                'phone' => $this->validator->clean($_POST['phone']),
                'profile-image' => "/upload/noimage.jpg"
            ];
        }
        return [];
    }

    public function validateErrors(): array
    {
        $errors = $this->validator->Validate($this->getValues());
        if (isset($this->getValues()['email']) && !User::isUniqueUser($this->getValues()['email'])) {
            $errors['unique_user'] = "Пользователь с Email: " . $this->getValues()['email'] . " уже существует.";
        }
        return $errors;
    }

    public function isUploadProfileImage(): bool
    {
        if (!empty($this->getImageName())) {
            return true;
        }
        return false;
    }
}