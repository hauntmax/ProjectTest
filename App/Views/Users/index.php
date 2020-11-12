<?php if (isset($_SESSION['authorize'])) {?>
    <?php if ($_SESSION['authorize']) {?>
        <div class="content">
            <?php
            var_dump($users);
            foreach ($users as $id => $user) { ?>
                <div class="block">
                    <h1>Имя: <a href="/user/<?=$id?>"><?=$user['name']?></a></h1>
                    <p>Email: <?=$user['email']?></p>
                    <p>Номер телефона: <?=$user['phone']?></p>
                    <a class="btn btn-warning" href="/user/update/<?=$id?>">Редактировать</a>
                    <a class="btn btn-danger" href='/user/delete/<?=$id?>'>Удалить</a>
                    <hr>
                </div>
            <?php } ?>
            <a class="btn btn-primary" href="/user/create/new">Добавить</a>
        </div>
    <?php }?>
<?php } else {
        header('HTTP/1.1 401 Unauthorized');
        header("Status: 401 Unauthorized");
    ?>
    <div class="content">
        <div class="block">
            <h3>Для просмотра страницы нужно авторизоваться</h3>
        </div>
    </div>
<?php } ?>