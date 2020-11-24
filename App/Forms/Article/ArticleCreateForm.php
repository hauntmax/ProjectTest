<?php


namespace App\Forms\Article;


use App\Forms\Form;
use App\Forms\Validators\ArticleValidator;

class ArticleCreateForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ArticleValidator();
    }

    public function getValues(array $data = null): array
    {
        if ($this->isSubmit()) {
            return [
                'id' => uniqid(),
                'heading' => $this->validator->clean($_POST['heading']),
                'text' => $this->validator->clean($_POST['text']),
                'creation-date' => date("d-m-Y H:i:s"),
                'creator-id' => $_SESSION['userId'],
                'creator-email' => $_SESSION['email']
            ];
        }
        return [];
    }

    public function validateErrors(): array
    {
        return $this->validator->Validate($this->getValues());
    }
}