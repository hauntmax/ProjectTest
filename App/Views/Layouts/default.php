<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/App/Public/css/style.css">
    <link rel="stylesheet" href="/App/Public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/App/Public/css/bootstrap-grid.min.css">
    <title><?=$title?></title>
</head>
<body>

<div class="wrapper">
    <!-- разметка для логотипа -->
    <header>
        <!-- разметка для меню -->
        <div class="top-menu">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/user/list">Пользователи</a></li>
                <li><a href="#">Сущности</a></li>
            </ul>
        </div>

        <div class="logo">
            <a href="/">
                <span class="use">USE</span>-
                <span class="web">WEB</span>.ru
            </a>
            <p>Разработка- это просто</p>
        </div>

         <!--блок с авторизацией -->
        <?php if (isset($_SESSION['isAuthorize'])) {
            if ($_SESSION['isAuthorize']) { ?>
                <div class="block-top-auth">
                    <p><a href="/user/<?=$_SESSION['userId']?>"><?=$_SESSION['email']?></a></p>
                    <p><a href="/login/logout">Выйти</a></p>
                </div>
            <?php } else { ?>
                <div class="block-top-auth">
                    <p><a href="/login">Вход</a></p>
                    <p><a href="/register">Регистрация</a></p>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="block-top-auth">
                <p><a href="/login">Вход</a></p>
                <p><a href="/register">Регистрация</a></p>
            </div>
        <?php } ?>

    </header>

    <?php echo $content; ?>

    <footer>
        <p>Футер сайта.</p>
    </footer>

</div>

</body>
</html>