<?php


session_start(); ?>

<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="display: flex; gap: 5px; max-width: 500px;">
    <?php if (empty($_SESSION['logged_in'])) : ?>
        <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/create-account">Create account</a>
        <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/login">Login</a>
    <?php else: ?>
        <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/profile">Profil</a>
    <?php endif; ?>
    </body>
</html>