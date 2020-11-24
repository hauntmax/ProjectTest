<div class="content">
    <?php
    var_dump($articles);
    foreach ($articles as $id => $article) { ?>
        <div class="block">
            <h3>Заголовок: <a href="/article/<?= $id ?>"><?= $article['heading'] ?></a></h3>
            <p>Текст: <?= $article['text'] ?></p>
            <p>Дата создания: <?= $article['creation-date'] ?></p>

            <p>Создатель: <a href="/user/<?= $article['creator-id'] ?>"><?= $article['creator-email'] ?></a></p>

            <?php if (isset($article['updater-id'])) { ?>
                <p>Дата изменения: <?=$article['updating-date'];?></p>
                <p>Изменил:
                    <a href="/user/<?= $article['updater-id'] ?>"><?= $article['updater-email'] ?></a>
                </p>
            <?php } else { ?>
                <p>Не изменено</p>
            <?php } ?>

            <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) { ?>
                <a class="btn btn-warning" href="/article/<?= $id ?>/update">Редактировать</a>
                <a class="btn btn-danger" href="/article/<?= $id ?>/delete">Удалить</a>
            <?php } ?>
            <hr>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) { ?>
        <a class="btn btn-primary" href="/article/create/new">Добавить</a>
    <?php } ?>
</div>