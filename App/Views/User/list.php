<div class="content">
    <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) { ?>
        <?php
        //var_dump($users);
        foreach ($users as $user) { ?>
            <div class="block">
                <?php if (isset($user['status_account']) && $user['status_account']) { ?>
                    <h2 class="alert-success">Аккаунт активирован</h2>
                <?php } else { ?>
                    <h2 class="alert-danger">Аккаунт не активирован</h2>
                <?php } ?>
                <h1>Имя: <a href="/user/<?= $user['id'] ?>"><?= $user['name'] ?></a></h1>
                <p>Email: <?= $user['email'] ?></p>
                <p>Номер телефона: <?= $user['phone'] ?></p>
                <a class="btn btn-warning" href="/user/<?= $user['id'] ?>/update">Редактировать</a>
                <a class="btn btn-danger" href="/user/<?= $user['id'] ?>/delete">Удалить</a>
                <hr>
            </div>
        <?php } ?>
        <a class="btn btn-primary" href="/user/create/new">Добавить</a>
    <?php } else {
        header('HTTP/1.1 401 Unauthorized');
        header("Status: 401 Unauthorized");
        ?>
        <div class="block">
            <h3>Для просмотра пользователей нужно авторизоваться</h3>
        </div>
    <?php } ?>
</div>
