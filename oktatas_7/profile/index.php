<?php
require('../includes/init.php');
require(MODELS_DIR . '/User.php');
session_start();

if (!empty($_POST) && array_key_exists('logout', $_POST) && !empty($_POST['logout'])) {
    $user = new User();
    $user->logout();
}

if (empty($_SESSION['logged_in'])) {
    redirect('/login');
}
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="display: flex; max-width: 500px;">
        <?php foreach($_SESSION['logged_in'] as $key => $data) : ?>
            <div style="display: flex; flex-direction: column;">
                <p><?php echo $key; ?></p>
                <p><?php echo $data; ?></p>
            </div>
        <?php endforeach; ?>

        <form method="POST">
            <input type="hidden" name="logout" value="true" />
            <input type="submit" value="Kijelentkezés" />
        </form>
    </body>
</html>
