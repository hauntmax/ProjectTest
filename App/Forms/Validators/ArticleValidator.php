<?php


namespace App\Forms\Validators;


class ArticleValidator extends Validator
{
    public function __construct()
    {
        $this->SetRule("heading", "isNotEmpty");
        $this->SetRule("text", "isNotEmpty");
    }
}