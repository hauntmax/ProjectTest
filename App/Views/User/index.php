<div class="content">
    <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) : ?>
        <?php if (isset($errorFind)) : ?>
            <h1><?= $errorFind ?></h1>
        <?php else : ?>
            <?php if (isset($user['profile_image'])) : ?>
                <div class="block">
                    <img class="img-thumbnail w-25 h-25" src="<?= $user['profile_image'] ?>" alt="user-profile">
                </div>
            <?php endif; ?>
            <?php if (isset($user['status_account']) && $user['status_account']) : ?>
                <h2 class="alert-success">Аккаунт активирован</h2>
            <?php else : ?>
                <h2 class="alert-danger">Аккаунт не активирован</h2>
            <?php endif; ?>
            <div class="block">
                <h1>Имя: <?= $user['name'] ?></h1>
                <p>Email: <?= $user['email'] ?></p>
                <p>Номер телефона: <?= $user['phone'] ?></p>
            </div>
            <?php if (isset($articles) && !empty($articles)) : ?>
                <h1>Статьи</h1>
                <?php foreach ($articles as $article) : ?>
                    <div class="block">
                        <h3>Заголовок: <a href="/article/<?= $article['id'] ?>"><?= $article['heading'] ?></a></h3>
                        <p>Дата создания: <?= $article['creation_date'] ?></p>
                        <p>Создатель: <a href="/user/<?= $article['user_id'] ?>"><?= $article['user_name'] ?></a></p>
                        <p>email: <?= $article['user_email'] ?></p>
                        <p>Номер телефона: <?= $article['user_phone'] ?></p>

                        <?php if (isset($article['updater_id'])) : ?>
                            <p>Дата изменения: <?= $article['updating_date']; ?></p>
                            <p>Изменил:
                                <a href="/user/<?= $article['updater_id'] ?>">Профиль</a>
                            </p>
                        <?php else : ?>
                            <p>Не изменено или удалён последний редактор</p>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) : ?>
                            <a class="btn btn-warning" href="/article/<?= $article['id'] ?>/update">Редактировать</a>
                            <a class="btn btn-danger" href="/article/<?= $article['id'] ?>/delete">Удалить</a>
                        <?php endif; ?>
                        <hr>
                    </div>
                <?php endforeach; ?>
                <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) { ?>
                    <a class="btn btn-primary" href="/article/create/new">Добавить</a>
                <?php } ?>
            <?php else : ?>
                <h1>У пользователя нет статей</h1>
            <?php endif; ?>
        <?php endif; ?>
    <?php else :
        header('HTTP/1.1 401 Unauthorized');
        header("Status: 401 Unauthorized");
        ?>
        <div class="content">
            <div class="block">
                <h3>Для просмотра профиля пользователя нужно авторизоваться</h3>
            </div>
        </div>
    <?php endif; ?>
</div>