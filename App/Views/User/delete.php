<div class="content">
    <form name="delete-user" action="" method="post">
        <p>Вы действительно хотите удалить пользователя
            <a href="/user/<?=$user['id']?>"><?=$user['name']?></a> ?
        </p>
        <p>
            <input type="submit" name="submit" id="submit" value="Удалить" class="btn btn-primary">
        </p>
    </form>
</div>