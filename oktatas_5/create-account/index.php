<?php
require('../includes/init.php');
require(INCLUDES_DIR . '/helpers.php');
require(MODELS_DIR . '/User.php');
require(CLASSES_DIR . '/FormController.php');

if (!empty($_GET)) {
    $errors = FormController::saveFormData($_GET);
}
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body style="display: flex; max-width: 500px;">
        <form method="GET">
            <?php foreach(FormController::getDefinition('userForm') as $definition) : ?>
                <div style="display: flex; flex-direction: column;">
                    <label><?php echo $definition['label']; ?></label>
                    <input 
                        type="<?php echo $definition['type'] ?? 'text'; ?>"
                        name="<?php echo $definition['key']; ?>" 
                        value="<?php echo FormController::getFieldValue($definition['key']); ?>"
                    />
                    <?php if (is_array($errors) && array_key_exists($definition['key'], $errors) && !empty($errors[$definition['key']])): ?>
                        <div style="color: red;"><?php echo $errors[$definition['key']]; ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <input type="submit" value="Beküldés" />
            <a style="background-color: red; color: white; padding: 2px 5px; border-radius:3px;" href="/">Vissza a főoldalra</a>
        </form>
    </body>
</html>
