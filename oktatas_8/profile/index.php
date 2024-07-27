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

$keyMap = ['id' => 'Azonosító', 'email' => 'E-mail cím', 'username' => 'Felhasználónév', 'created_at' => 'Létrehozási idő'];

?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="display: flex; flex-wrap: wrap; gap: 15px; max-width: 800px;">
        <?php foreach($_SESSION['logged_in'] as $key => $data) : ?>
            <div style="display: flex; flex-direction: column;">
                <p><?php echo $keyMap[$key]; ?></p>
                <p><?php echo $data; ?></p>
            </div>
        <?php endforeach; ?>

        <form method="POST" style="flex: 1 0 100%;">
            <input type="hidden" name="logout" value="true" />
            <input type="submit" value="Kijelentkezés" />
        </form>

        <a href="/profile/update">Adatok módosítása</a>
    </body>
</html>
