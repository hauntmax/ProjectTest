<?php

function clean(string $value): string {
    $value = trim($value); // удалить пробелы
    $value = stripslashes($value); // удалить экранированные символы
    $value = strip_tags($value); // удалить html и php теги
    $value = htmlspecialchars($value); // преобразовать специальные символы в HTML-сущности
    return $value;
}

function check_length(string $value, int $min, int $max): bool {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}

function checkEmptyUserData(array $userdata): array
{
    $errors = array();
    if (empty(clean($userdata['name']))){
        $errors[] = "Имя обязательно для заполнения<br>";
    }

    if (empty(clean($userdata['email']))){
        $errors[] = "Email обязателен для заполнения<br>";
    }

    if (empty(clean($userdata['phone']))){
        $errors[] = "Номер телефона обязателен для заполнения<br>";
    }

    if (empty(clean($userdata['password']))) {
        $errors[] = "Нужно заполнить пароль<br>";
    }
    return $errors;
}

function checkValidateUser(array $userdata): array
{
    $errors = array();

    if (!empty(checkEmptyUserData($userdata))){
        return checkEmptyUserData($userdata);
    }

    if (!preg_match("/^[a-zA-Zа-яёА-ЯЁ ]+$/ui", $userdata['name'])){
        $errors[] = "Имя должно содержать только буквы и пробелы<br>";
    }

    if (!filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = "Неверный формат email<br>";
    }

    if (!preg_match("/^[0-9]{10,12}+$/", $userdata['phone'])){
        $errors[] = "Телефон задан в неверном формате<br>";
    }

    if (!check_length($userdata['password'], 4, PHP_INT_MAX)) {
        $errors[] = "Пароль должен содержать от 4 символов<br>";
    }

    return $errors;
}