<?php
require('./includes/init.php');
require(INCLUDES_DIR . '/helpers.php');
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="display: flex; flex-wrap: wrap; gap: 5px; max-width: 500px;">
        <div style="display: flex; flex-direction: column; flex: 1 0 auto;">
            <?php foreach(getUserData() as $formData) : ?>
                <?php foreach($formData as $key => $data) : ?>
                    <div style="display: flex; gap: 4px;">
                        <span><?php echo $key; ?>:</span>
                        <span><?php echo $data; ?></span>
                    </div> 
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
        <div stlye="flex: 1 0 auto;">
            <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/create-account">Create account</a>
            <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/login">Login</a>
        </div>
    </body>
</html>
<?php
// 1. Json fájlba szervezni a definíciókat
// 2. Json fájlba menteni a form bemenetet
// 3. Validáció / Hibaüzeneteket visszaírni a felhasználónak
// 4. Kiüríteni a formunkat, sikeres beküldés esetén
// egyéb: Szérializált adat bemutatása