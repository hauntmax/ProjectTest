<?php include_once $_SERVER['DOCUMENT_ROOT']."/header.php" ?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/functions/save_user.php" ?>

<?php
    if(isset($_POST['submit'])) {
        $inputUserData = array(
            'id' => uniqid(),
            'name' => clean($_POST['name']),
            'email' => clean($_POST['email']),
            'password' => sha1(clean($_POST['password'])),
            'phone' => clean($_POST['phone'])
        );
        save_user($_SERVER['DOCUMENT_ROOT']."/userdata", $inputUserData);
    }
?>

    <div class="content">
        <form name="add-user" action="" method="post">
            <p>
                <label for="name">Имя </label>
                <input type="text" name="name" id="name"
                       value="<?php if(isset($_POST["name"])) echo $_POST["name"]; ?>" autofocus>
            </p>
            <p>
                <label for="email">Email </label>
                <input type="text" name="email" id="email"
                       value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>">
            </p>
            <p>
                <label for="password">Пароль </label>
                <input type="password" name="password" id="password"
                       value="<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>">
            </p>
            <p>
                <label for="phone">Номер телефона </label>
                <input type="text" name="phone" id="phone"
                       value="<?php if(isset($_POST["phone"])) echo $_POST["phone"]; ?>">
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Добавить" class="btn btn-primary">
            </p>
        </form>
    </div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/footer.php" ?>