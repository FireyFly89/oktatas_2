<?php
$fieldDefinitions = [
    [
        'key' => 'email',
        'label' => 'E-mail',
    ],
    [
        'key' => 'username',
        'label' => 'Felhasználónév',
    ],
    [
        'key' => 'fullname',
        'label' => 'Név',
    ],
    [
        'key' => 'password',
        'label' => 'Jelszó',
        'type' => 'password'
    ],
    [
        'key' => 'password_repeat',
        'label' => 'Jelszó ismétlése',
        'type' => 'password'
    ],
];
/*
$email = "";
$userName = "";
$fullName = "";

if (!empty($_GET)) {
    $email = $_GET['email'];
}

if (!empty($_GET)) {
    $userName = $_GET['username'];
}

if (!empty($_GET)) {
    $fullName = $_GET['fullname'];
}*/

/*
if (!empty($_GET)) {
    foreach($_GET as $fieldName => $fieldValue) {
        ${$fieldName} = $fieldValue;
    }
}*/

function getFieldValue($key) {
    /*if (!empty($_GET)) {
        if (array_key_exists($key, $_GET)) {
            return $_GET[$key];
        }
    }*/

    /*if (!empty($_GET) && array_key_exists($key, $_GET)) {
        return $_GET[$key];
    }*/

    if (empty($_GET) && !array_key_exists($key, $_GET)) {
        return '';
    }

    return $_GET[$key];
}
?>
<!DOCTYPE html>
    <head></head>
    <body style="display: flex; max-width: 500px;">
        <form method="GET">
            <?php foreach($fieldDefinitions as $definition) : ?>
                <div style="display: flex; flex-direction: column;">
                    <label><?php echo $definition['label']; ?></label>
                    <input type="<?php echo $definition['type'] ?? 'text'; ?>" name="<?php echo $definition['key']; ?>" value="<?php echo getFieldValue($definition['key']); ?>" />
                </div>
            <?php endforeach; ?>

            <input type="submit" value="Beküldés" />
        </form>
    </body>
</html>

<?php
$request = "";
/*
if (!empty($_SERVER['REQUEST_URI'])) {
    $request = $_SERVER['REQUEST_URI'];
}
$params = explode('?', $request);
$keyValuePair = explode('=', $params[1]);
$paramsProcessed = [];
$paramsProcessed[$keyValuePair[0]] = $keyValuePair[1];
pd($paramsProcessed);
*/

function dd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function pd(mixed $data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}