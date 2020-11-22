<?php


namespace App\FormBuilder;


class Field
{
    // Простые поля
    const TEXT = 'text';
    const TEXTAREA = 'textarea';
    const SELECT = 'select';
    const CHOICE = 'choice';
    const CHECKBOX = 'checkbox';
    const RADIO = 'radio';
    const PASSWORD = 'password';
    const HIDDEN = 'hidden';
    const FILE = 'file';

    // Поля даты
    const DATE = 'date';
    const DATETIME_LOCAL = 'datetime-local';
    const MONTH = 'month';
    const TIME = 'time';
    const WEEK = 'week';

    // Поля специального назначения
    const COLOR = 'color';
    const SEARCH = 'search';
    const IMAGE = 'image';
    const EMAIL = 'image';
    const ULR = 'url';
    const TEL = 'tel';
    const NUMBER = 'number';
    const RANGE = 'range';
    const ENTITY = 'entity';
    const FORM = 'form';

    // Кнопки
    const BUTTON_SUBMIT = 'submit';
    const BUTTON_RESET = 'reset';
    const BUTTON = 'button';
}