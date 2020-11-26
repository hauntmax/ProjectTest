<div class="content">
    <?php
    var_dump($articles);
    foreach ($articles as $article) { ?>
        <div class="block">
            <h3>Заголовок: <a href="/article/<?= $article['id'] ?>"><?= $article['heading'] ?></a></h3>
            <p>Дата создания: <?= $article['creation_date'] ?></p>

            <p>Создатель: <a href="/user/<?= $article['user_id'] ?>">Профиль</a></p>

            <?php if (isset($article['updater_id'])) { ?>
                <p>Дата изменения: <?=$article['updating_date'];?></p>
                <p>Изменил:
                    <a href="/user/<?= $article['updater_id'] ?>">Профиль</a>
                </p>
            <?php } else { ?>
                <p>Не изменено или удалён последний редактор</p>
            <?php } ?>

            <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) { ?>
                <a class="btn btn-warning" href="/article/<?= $article['id'] ?>/update">Редактировать</a>
                <a class="btn btn-danger" href="/article/<?= $article['id'] ?>/delete">Удалить</a>
            <?php } ?>
            <hr>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) { ?>
        <a class="btn btn-primary" href="/article/create/new">Добавить</a>
    <?php } ?>
</div>