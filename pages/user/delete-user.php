<?php include_once $_SERVER['DOCUMENT_ROOT']."/header.php" ?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/functions/get_user.php"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/functions/delete_user.php"; ?>

<?php
    $user = get_user($_GET['id']);
    if(isset($_POST['submit'])) {
        delete_user($_GET['id']);
        header("Location: "."users.php");
    }
?>

<div class="content">
    <form name="delete-user" action="" method="post">
        <p>Вы действительно хотите удалить пользователя
            <a href="user.php?id=<?=$_GET['id']?>"><?=$user['name']?></a> ?
        </p>
        <p>
            <input type="submit" name="submit" id="submit" value="Удалить" class="btn btn-primary">
        </p>
    </form>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/footer.php" ?>

