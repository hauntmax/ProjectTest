<div class="content">
    <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) : ?>
        <?php if (isset($errorFind)) : ?>
            <h1><?= $errorFind ?></h1>
        <?php else : ?>
            <form name="delete-user" action="" method="post">
                <p>Вы действительно хотите удалить пользователя
                    <a href="/user/<?= $user['id'] ?>"><?= $user['name'] ?></a> ?
                </p>
                <p>
                    <input type="submit" name="submit" id="submit" value="Удалить" class="btn btn-primary">
                </p>
            </form>
        <?php endif; ?>
    <?php else :
        header('HTTP/1.1 401 Unauthorized');
        header("Status: 401 Unauthorized"); ?>
        <div class="block">
            <h3>Для удаления пользователя нужно авторизоваться</h3>
        </div>
    <?php endif; ?>
</div>