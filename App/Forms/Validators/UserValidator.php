<?php


namespace App\Forms\Validators;


class UserValidator extends Validator
{
    public function __construct()
    {
        $this->SetRule("name", "checkName", "isNotEmpty");
        $this->SetRule("email", "isEmail", "isNotEmpty");
        $this->SetRule("password", "isNotEmpty");
        $this->SetRule("phone", "checkPhone", "isNotEmpty");
    }

    public function checkName(string $name)
    {
        if (!preg_match("/^[a-zA-Zа-яёА-ЯЁ ]+$/ui", $name)){
            return "Имя должно содержать только буквы и пробелы";
        }
    }

    public function checkPhone(string $phone)
    {
        if (!preg_match("/^[0-9]{10,12}+$/", $phone)){
            return "Телефон задан в неверном формате (должен содержать от 10 до 12 цифр)";
        }
    }
}