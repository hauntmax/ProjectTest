<div class="content">
    <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) : ?>
        <?php if (isset($errorsValidate)) : ?>
            <?php foreach ($errorsValidate as $error) : ?>
                <p class="alert-danger"><?= $error ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($errorFind)) : ?>
            <h1><?= $errorFind ?></h1>
        <?php else: ?>
            <form name="update-article" action="" method="post">
                <div class="form-group">
                    <label for="heading">Заголовок</label>
                    <input type="text" name="heading" id="heading" class="form-control" placeholder="Заголовок"
                           value="<?php if (isset($_POST["heading"]))
                               echo $_POST["heading"];
                           else echo $article['heading'] ?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="text">Текст статьи</label>
                    <textarea type="text" name="text" id="text" class="form-control"
                              placeholder="Текст статьи"><?php if (isset($_POST["text"])) echo $_POST["text"]; else echo $article['text'] ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" value="Обновить" class="btn btn-primary">
                </div>
            </form>
        <?php endif; ?>
    <?php else :
        header('HTTP/1.1 401 Unauthorized');
        header("Status: 401 Unauthorized"); ?>
        <div class="block">
            <h3>Для редактирования статьи нужно авторизоваться</h3>
        </div>
    <?php endif; ?>
</div>