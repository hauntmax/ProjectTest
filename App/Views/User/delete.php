<div class="content">
    <?php if (isset($errorFind)) { ?>
        <h1><?=$errorFind?></h1>
    <?php } else { ?>
        <form name="delete-user" action="" method="post">
            <p>Вы действительно хотите удалить пользователя
                <a href="/user/<?=$user['id']?>"><?=$user['name']?></a> ?
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Удалить" class="btn btn-primary">
            </p>
        </form>
    <?php } ?>
</div>