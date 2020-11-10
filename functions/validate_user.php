<?php

function clean(string $value): string {
    $value = trim($value); // удалить пробелы
    $value = stripslashes($value); // удалить экранированные символы
    $value = strip_tags($value); // удалить html и php теги
    $value = htmlspecialchars($value); // преобразовать специальные символы в HTML-сущности
    return $value;
}

//function check_length(string $value, int $min, int $max): bool {
//    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
//    return !$result;
//}

function isEmptyUserData(array $userdata): bool {
    $result = false;
    if (empty($userdata['name'])){
        echo "Имя обязательно для заполнения<br>";
        $result = true;
    }

    if (empty($userdata['email'])){
        echo "Email обязателен для заполнения<br>";
        $result = true;
    }

    if (empty($userdata['phone'])){
        echo "Номер телефона обязателен для заполнения<br>";
        $result = true;
    }
    return $result;
}

function validate_user(array $userdata): bool {
    $result = true;

    if (isEmptyUserData($userdata)){
        return false;
    }

    if (!preg_match("/^[a-zA-Zа-яёА-ЯЁ ]+$/ui", $userdata['name'])){
        echo "Имя должно содержать только буквы и пробелы<br>";
        $result = false;
    }

    if (!filter_var($userdata['email'], FILTER_VALIDATE_EMAIL)){
        echo "Неверный формат email<br>";
        $result = false;
    }

    if (!preg_match("/^[0-9]{10,12}+$/", $userdata['phone'])){
        echo "Телефон задан в неверном формате<br>";
        $result = false;
    }

    return $result;
}