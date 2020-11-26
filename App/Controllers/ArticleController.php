<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Forms\Article\ArticleCreateForm;
use App\Forms\Article\ArticleDeleteForm;
use App\Forms\Article\ArticleUpdateForm;
use App\Models\Article;
use App\Models\User;

class ArticleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function IndexAction()
    {
        $article = Article::getById($this->routeParams['id']);
        if ($article) {
            $this->view->render("Статья", [
                'article' => $article,
            ]);
        } else {
            $this->view->render("Статья", [
                'errorFind' => "Нет статьи с ID: " . $this->routeParams['id']
            ]);
        }
    }

    public function ListAction()
    {
        $this->view->render("Статьи", [
            'articles' => Article::getAll()
        ]);
    }

    public function CreateAction()
    {
        $form = new ArticleCreateForm();
        $createValues = $form->getValues();
        if (empty($createValues)) {
            $this->view->render('Создать статью');
        }
        if (!empty($form->validateErrors())) {
            $this->view->render('Создать статью', [
                'errorsValidate' => $form->validateErrors()
            ]);
        } else {
            Article::create($createValues);
            $this->view->redirect('/article/list');
        }
    }

    public function UpdateAction()
    {
        $form = new ArticleUpdateForm();
        $article = Article::getById($this->routeParams['id']);
        if (!$article) {
            $this->view->render('Обновить статью', [
                'errorFind' => "Нет статьи с ID: " . $this->routeParams['id']
            ]);
        }
        $updateValues = $form->getValues($article);
        if (empty($updateValues)) {
            $this->view->render('Обновить статью', [
                'article' => $article
            ]);
        }
        if (!empty($form->validateErrors($article))) {
            $this->view->render("Редактировать статью", [
                'errorsValidate' => $form->validateErrors($article)
            ]);
        } else {
            Article::update($updateValues);
            $this->view->redirect("/article/" . $this->routeParams['id']);
        }
    }

    public function DeleteAction()
    {
        $form = new ArticleDeleteForm();
        $article = Article::getById($this->routeParams['id']);
        if (!$article) {
            $this->view->render("Удалить статью", [
                'errorFind' => "Нет статьи с ID: " . $this->routeParams['id']
            ]);
        }
        if (!$form->isSubmit()) {
            $this->view->render("Удалить пользователя", [
                'article' => Article::getById($this->routeParams['id'])
            ]);
        } else {
            Article::delete($this->routeParams['id']);
            $this->view->redirect("/article/list");
        }
    }
}