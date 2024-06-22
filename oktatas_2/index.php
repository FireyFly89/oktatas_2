<?php
require('./includes/init.php');
require(INCLUDES_DIR . '/helpers.php');
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
<?php
// 1. Json fájlba szervezni a definíciókat
// 2. Json fájlba menteni a form bemenetet
// 3. Validáció / Hibaüzeneteket visszaírni a felhasználónak
// 4. Kiüríteni a formunkat, sikeres beküldés esetén
// egyéb: Szérializált adat bemutatása