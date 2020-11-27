<?php

/**
 * Преобразует строку, в которой слова разделены (_) к CamelCase с большой первой буквой
 * @param $string
 * @param false $capitalizeFirstCharacter
 * @return string
 */
function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
{

    $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

    if (!$capitalizeFirstCharacter) {
        $str[0] = strtolower($str[0]);
    }

    return ucfirst($str);
}
