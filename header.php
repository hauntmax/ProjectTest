<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-grid.min.css">
    <title>Document</title>
</head>
<body>

<div class="wrapper">
    <!-- разметка для логотипа -->
    <header>
        <!-- разметка для меню -->
        <div class="top-menu">
            <ul>
                <li><a href="/index.php">Главная</a></li>
                <li><a href="/pages/user/users.php">Пользователи</a></li>
                <li><a href="/pages/entity/entities.php">Сущности</a></li>
            </ul>
        </div>

        <div class="logo">
            <a href="/index.php">
                <span class="use">USE</span>-
                <span class="web">WEB</span>.ru
            </a>
            <p>Разработка- это просто</p>
        </div>

        <!-- блок с авторизацией -->
        <?php if (isset($_SESSION['authorize'])) {
            if ($_SESSION['authorize']) { ?>
                <div class="block-top-auth">
                    <p><a href="/pages/user/user.php?id=<?=$_SESSION['userId']?>"><?=$_SESSION['email']?></a></p>
                    <p><a href="/logout.php">Выйти</a></p>
                </div>
            <?php } else { ?>
                <div class="block-top-auth">
                    <p><a href="/login.php">Вход</a></p>
                    <p><a href="/register.php">Регистрация</a></p>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="block-top-auth">
                <p><a href="/login.php">Вход</a></p>
                <p><a href="/register.php">Регистрация</a></p>
            </div>
        <?php } ?>

    </header>

