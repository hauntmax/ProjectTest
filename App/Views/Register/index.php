<div class="content">
    <?php if (isset($errorUnique)) { ?>
        <p class="alert-danger"><?=$errorUnique?></p>
    <?php } ?>
    <?php if (isset($errorsValidate)) { ?>
        <?php foreach ($errorsValidate as $error) { ?>
            <p class="alert-danger"><?=$error?></p>
        <?php } ?>
    <?php } ?>
    <form enctype="multipart/form-data" name="add-user" action="" method="post">
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Имя"
                   value="<?php if(isset($_POST["name"])) echo $_POST["name"]; ?>" autofocus>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                   value="<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Пароль"
                   value="<?php if(isset($_POST["password"])) echo $_POST["password"]; ?>">
        </div>
        <div class="form-group">
            <label for="phone">Номер телефона</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Номер телефона"
                   value="<?php if(isset($_POST["phone"])) echo $_POST["phone"]; ?>">
        </div>
        <div class="form-group">
            <label for="phone">Фото профиля</label>
            <input type="file" name="profile-image" id="profile-image"
                   class="form-control-file">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit" value="Зарегистрироваться" class="btn btn-primary">
        </div>
    </form>
</div>