<?php
require('../includes/init.php');
require(INCLUDES_DIR . '/helpers.php');
$errors = login();
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="display: flex; flex-direction: column; max-width: 500px;">
        <h2>Belépés</h2>
        <form method="GET">
            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label>E-mail cím</label>
                <input type="text" name="email" value="" />
                <?php if (is_array($errors) && array_key_exists('email', $errors) && !empty($errors['email'])): ?>
                    <div style="color: red;"><?php echo $errors['email']; ?></div>
                <?php endif; ?>

                <label>Jelszó</label>
                <input type="password" name="password" />
                <?php if (is_array($errors) && array_key_exists('password', $errors) && !empty($errors['password'])): ?>
                    <div style="color: red;"><?php echo $errors['password']; ?></div>
                <?php endif; ?>

                <input type="submit" value="Beküldés" />
            </div>
            <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/">Vissza a főoldalra</a>
        </form>
    </body>
</html>