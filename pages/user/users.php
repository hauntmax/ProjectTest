<?php include_once $_SERVER['DOCUMENT_ROOT']."/header.php" ?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/functions/get_users.php" ?>

<?php if ($_SESSION['authorize']) {?>
    <div class="content">
        <?php
        $users = get_users($_SERVER['DOCUMENT_ROOT']."/userdata");
        var_dump($users);
        foreach ($users as $id => $user) { ?>
            <div class="block">
                <h1>Имя: <a href="user.php?id=<?=$id?>"><?=$user['name']?></a></h1>
                <p>Email: <?=$user['email']?></p>
                <p>Номер телефона: <?=$user['phone']?></p>
                <a class="btn btn-warning" href="edit-user.php?id=<?=$id?>">Редактировать</a>
                <a class="btn btn-danger" href='delete-user.php?id=<?=$id?>'>Удалить</a>
                <hr>
            </div>
        <?php } ?>
        <a class="btn btn-primary" href="add-user.php">Добавить</a>
    </div>

<?php } else { header("Location: "."/401.php"); }?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/footer.php" ?>


