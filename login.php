<?php include_once $_SERVER['DOCUMENT_ROOT']."/header.php" ?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/validate_user.php"; ?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/login_user.php"; ?>

<?php
if(isset($_POST['submit'])) {
    $loginData = array(
        'email' => clean($_POST['email']),
        'password' => clean($_POST['password'])
    );

    if (login_user($_SERVER['DOCUMENT_ROOT']."/userdata", $loginData)){
        header("Location: "."/pages/user/users.php");
    } else {
        header("Location: "."401.php");
    }
}
?>

    <div class="content">
        <form name="add-user" action="" method="post">
            <p>
                <label for="email">Email </label>
                <input type="text" name="email" id="email"
                       value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>" autofocus>
            </p>
            <p>
                <label for="password">Пароль </label>
                <input type="password" name="password" id="password"
                       value="<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Войти" class="btn btn-primary">
            </p>
        </form>
    </div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/footer.php" ?>