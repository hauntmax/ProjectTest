<div class="content">
    <?php if (isset($_SESSION['isAuthorize']) && $_SESSION['isAuthorize']) { ?>
        <?php if (isset($errorFind)) { ?>
            <h1><?=$errorFind?></h1>
        <?php } else { ?>
            <?php if (isset($user['profile_image'])) { ?>
                <div class="block">
                    <img class="img-thumbnail w-25 h-25" src="<?=$user['profile_image']?>" alt="user-profile">
                </div>
            <?php } ?>
            <?php if (isset($user['status_account']) && $user['status_account']) { ?>
                <h2 class="alert-success">Аккаунт активирован</h2>
            <?php } else { ?>
                <h2 class="alert-danger">Аккаунт не активирован</h2>
            <?php } ?>
            <h1>Имя: <?=$user['name']?></h1>
            <p>Email: <?=$user['email']?></p>
            <p>Номер телефона: <?=$user['phone']?></p>
        <?php } ?>
    <?php } else {
        header('HTTP/1.1 401 Unauthorized');
        header("Status: 401 Unauthorized");
        ?>
        <div class="content">
            <div class="block">
                <h3>Для просмотра профиля пользователя нужно авторизоваться</h3>
            </div>
        </div>
    <?php } ?>
</div>