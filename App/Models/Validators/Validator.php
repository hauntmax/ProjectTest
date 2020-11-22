<?php


namespace App\Models\Validators;


class Validator
{
    private array $rules;
    private array $errors;

    public function isNotEmpty($data)
    {
        if (empty($data)) {
            return 'Поле не заполнено';
        }
    }

    public function isInteger($data)
    {
        if (!is_int($data)) {
            return 'Поле должно содержать только целые числа';
        }
    }

    public function isLess($data, $value)
    {
        if (is_int($data) && $data >= $value) {
            return 'Значение должно быть меньше, чем ' . $value;
        }
    }

    public function isGreater($data, $value)
    {
        if (is_int($data) && $data <= $value) {
            return 'Значение должно быть больше, чем ' . $value;
        }
    }

    public function isEmail($data)
    {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return 'Неверный формат EmailL: ' . $data;
        }
    }

    public function clean(string $value): string
    {
        $value = trim($value); // удалить пробелы
        $value = stripslashes($value); // удалить экранированные символы
        $value = strip_tags($value); // удалить html и php теги
        $value = htmlspecialchars($value); // преобразовать специальные символы в HTML-сущности
        return $value;
    }

    public function SetRule($field_name, $validator_name, $external = NULL)
    {
        $this->rules[$field_name] = is_null($external) ? $validator_name : [$validator_name, $external];
    }

    public function Validate($data)
    {
        foreach ($this->rules as $key => $value) {
            if (isset($data[$key])) {
                if (is_array($this->rules[$key])) {
                    $func = $value[0];
                    $this->errors[$key] = $this->$func($data[$key], $this->rules[$key][1]);
                } else {
                    $func = $value;
                    $this->errors[$key] = $this->$func($data[$key]);
                }
            }
        }
        return array_filter($this->errors, function ($error) {
            return $error !== null;
        });
    }
}