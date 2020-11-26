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

    public function getImageTmpName()
    {
        return isset($_FILES['profile-image']['tmp_name']) ? $_FILES['profile-image']['tmp_name'] : "";
    }

    public function getValues(array $data = null): array
    {
        if ($this->isSubmit()) {
            return [
                'id' => uniqid(),
                'name' => $this->validator->clean($_POST['name']),
                'email' => $this->validator->clean($_POST['email']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'phone' => $this->validator->clean($_POST['phone']),
                'profile_image' => "/upload/noimage.jpg"
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
        if (!empty($_FILES['profile-image']['name'])) {
            return true;
        }
        return false;
    }
}