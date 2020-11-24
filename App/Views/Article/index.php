<div class="content">
    <?php if (isset($errorFind)) { ?>
        <h1><?=$errorFind?></h1>
    <?php } else { ?>
        <h3>Заголовок: <?=$article['heading']?></h3>
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
    <?php } ?>
</div>