<?php
require('./includes/init.php');
require(INCLUDES_DIR . '/helpers.php');
require(CLASSES_DIR . '/Validation.php');
require(MODELS_DIR . '/User.php');
$user = new User(24);
dd($user);
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="display: flex; gap: 5px; max-width: 500px;">
        <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/create-account">Create account</a>
        <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/login">Login</a>
    </body>
</html>