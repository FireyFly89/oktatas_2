<?php
function getDefinition(string $name) {
    $path = sprintf('%s/%sDefinition.json', DEFINITIONS_DIR, $name);
    return json_decode(file_get_contents($path), true);
}

function getFieldValue(string|int $key) {
    if (empty($_GET) && !array_key_exists($key, $_GET)) {
        return '';
    }

    return $_GET[$key];
}

/*
1. Nézzünk utána, hogy mi az a REGEX
2. Csináljuk meg, az e-mail validációt REGEX használatával
3. Csináljunk jelszó validációt REGEX használatával
4. Új mezők, és hozzá validációt megoldani, label alapján, látszik a validáció:
{
    "key": "country_and_city",
    "label": "Ország, város"
},
{
    "key": "address",
    "label": "Utca, házszám"
},
*/
function saveFormData(string $name = '') {
    if (empty($_GET)) {
        return false;
    }

    $errors = [];

    foreach ($_GET as $key => $fieldData) {
        if ($key === 'email') {
            if (!str_contains($fieldData, '@')) {
                $errors[$key] = 'Helytelen e-mail cím';
            }
        } else if ($key === 'username') {
            if (strlen($fieldData) <= 6) {
                $errors[$key] = 'Túl rövid a felhasználónév';
            }
        }
    }

    if (!empty($errors)) {
        return $errors;
    }

    $id = rand(1, 9999);

    if (empty($name)) {
        // SOHA nem hozunk létre dinamikusan fájlokat input mezőre hagyatkozva, ez most kivétel!
        $name = sprintf('%s_%s.json', $id, $_GET['username']);
    }

    $path = sprintf('%s/%s.json', SUBMITTED_DATA_DIR, $name);
    file_put_contents($path, json_encode($_GET));
    redirect('/login');
}

function redirect(string $path = '/') {
    header('Location: ' . $path);
    exit;
}

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
