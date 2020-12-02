<div class="content">
    <?php if (isset($errorFind)) : ?>
        <h1><?= $errorFind ?></h1>
    <?php else: ?>
        <h3>Заголовок: <?= $article['heading'] ?></h3>
        <p>Текст: <?= $article['text'] ?></p>
        <p>Дата создания: <?= $article['creation_date'] ?></p>

        <p>Создатель: <a href="/user/<?= $article['user_id'] ?>"><?= $article['user_name'] ?></a>
        <p>email: <?= $article['user_email'] ?></p>
        <p>Номер телефона: <?= $article['user_phone'] ?></p>
        </p>

        <?php if (isset($article['updater_id'])) : ?>
            <p>Дата изменения: <?= $article['updating_date']; ?></p>
            <p>Изменил:
                <a href="/user/<?= $article['updater_id'] ?>">Профиль</a>
            </p>
        <?php else: ?>
            <p>Не изменено или удалён последний редактор</p>
        <?php endif; ?>

        <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']): ?>
            <h3>Рейтинг</h3>
            <!-- star rating data-id="$article['id']" -->
            <div class="star-rating__container">
                <div class="star-rating__wrapper">
                    <div class="star-rating__avg"></div>
                    <div class="star-rating" data-id="<?= $article['id'] ?>">
                        <div class="star-rating__bg">
                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                <svg class="star-rating__item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                          d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z">
                                    </path>
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <div class="star-rating__live">
                            <?php for ($i = 1; $i <= 10; $i++) : ?>
                                <svg class="star-rating__item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                     data-rating="<?= $i ?>">
                                    <path fill="currentColor"
                                          d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z">
                                    </path>
                                </svg>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="star-rating__votes"></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>