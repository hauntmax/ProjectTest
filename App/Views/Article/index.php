<div class="content">
    <?php if (isset($errorFind)) { ?>
        <h1><?= $errorFind ?></h1>
    <?php } else { ?>
        <h3>Заголовок: <?= $article['heading'] ?></h3>
        <p>Текст: <?= $article['text'] ?></p>
        <p>Дата создания: <?= $article['creation_date'] ?></p>

        <p>Создатель: <a href="/user/<?= $article['user_id'] ?>"><?= $article['user_name'] ?></a>
            <p>email: <?= $article['user_email'] ?></p>
            <p>Номер телефона: <?= $article['user_phone'] ?></p>
        </p>

        <?php if (isset($article['updater_id'])) { ?>
            <p>Дата изменения: <?= $article['updating_date']; ?></p>
            <p>Изменил:
                <a href="/user/<?= $article['updater_id'] ?>">Профиль</a>
            </p>
        <?php } else { ?>
            <p>Не изменено или удалён последний редактор</p>
        <?php } ?>
    <?php } ?>
</div>