<div class="content">
    <?php if (isset($errorLogin)) { ?>
        <h3 class="alert-danger"><?=$errorLogin?></h3>
    <?php } ?>
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