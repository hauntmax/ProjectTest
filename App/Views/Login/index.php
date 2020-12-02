<div class="content">
    <?php if (isset($errorLogin)) : ?>
        <h3 class="alert-danger"><?= $errorLogin ?></h3>
    <?php endif; ?>
    <form name="login-form" action="" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                   value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Пароль"
                   value="<?php if (isset($_POST["password"])) echo $_POST["password"]; ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit" value="Войти" class="btn btn-primary">
        </div>
    </form>
</div>