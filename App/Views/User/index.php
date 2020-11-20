<div class="content">
    <?php if (isset($errorFind)) { ?>
        <h1><?=$errorFind?></h1>
    <?php } else { ?>
        <?php if (isset($user['profile-image'])) { ?>
            <div class="block">
                <img class="img-thumbnail w-50 h-50" src="<?=$user['profile-image']?>" alt="user-profile">
            </div>
        <?php } ?>
        <?php if (isset($user['status-account']) && $user['status-account']) { ?>
            <h2 class="alert-success">Аккаунт активирован</h2>
        <?php } else { ?>
            <h2 class="alert-danger">Аккаунт не активирован</h2>
        <?php } ?>
        <h1>Имя: <?=$user['name']?></h1>
        <p>Email: <?=$user['email']?></p>
        <p>Номер телефона: <?=$user['phone']?></p>
    <?php } ?>
</div>