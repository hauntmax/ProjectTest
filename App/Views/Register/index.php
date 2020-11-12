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
            <input type="submit" name="submit" id="submit" value="Зарегистрироваться" class="btn btn-primary">
        </p>
    </form>
</div>