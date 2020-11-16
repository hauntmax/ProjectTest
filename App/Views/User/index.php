<div class="content">
    <?php if (isset($user['profile-image'])) { ?>
        <div class="block">
            <img class="img-thumbnail w-50 h-50" src="<?=$user['profile-image']?>" alt="user-profile">
        </div>
    <?php } ?>
    <h1>Имя: <?=$user['name']?></h1>
    <p>Email: <?=$user['email']?></p>
    <p>Номер телефона: <?=$user['phone']?></p>
</div>