<?php include_once $_SERVER['DOCUMENT_ROOT']."/header.php" ?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/functions/get_user.php" ?>

    <div class="content">
        <?php
            $user = get_user($_GET['id']);
        ?>
        <h1>Имя: <?=$user['name']?></h1>
        <p>Email: <?=$user['email']?></p>
        <p>Номер телефона: <?=$user['phone']?></p>
    </div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/footer.php" ?>