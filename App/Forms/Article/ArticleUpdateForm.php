<?php


namespace App\Forms\Article;

use App\Forms\Validators\ArticleValidator;

class ArticleUpdateForm extends ArticleCreateForm
{
    public function __construct()
    {
        parent::__construct();
        $this->validator = new ArticleValidator();
    }

    public function getValues(array $article = null): array
    {
        if ($this->isSubmit()) {
            return [
                'id' => $article['id'],
                'heading' => $this->validator->clean($_POST['heading']),
                'text' => $this->validator->clean($_POST['text']),
                'creation-date' => $article['creation-date'],
                'updating-date' => date("d-m-Y H:i:s"),
                'creator-id' => $article['creator-id'],
                'creator-email' => $article['creator-email'],
                'updater-id' => $_SESSION['userId'],
                'updater-email' => $_SESSION['email']
            ];
        }
        return [];
    }

    public function validateErrors(array $article = null): array
    {
        return $this->validator->Validate($this->getValues($article));
    }
}