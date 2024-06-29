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
function login() {
    if (empty($_GET)) {
        return false;
    }

    $formData = $_GET;
    $errors = [];

    if (empty($formData['email'])) {
        $errors['email'] = 'Az email cím megadása kötelező!';
    }

    if (empty($formData['password'])) {
        $errors['password'] = 'A jelszó mező megadása kötelező!';
    }

    if (!empty($errors)) {
        return $errors;
    }

    $userData = getUserData();

    foreach($userData as $user) {
        if ($formData['email'] === $user['email'] && password_verify($formData['password'], $user['password'])) {
            $_SESSION['logged_in'] = $user;
        }
    }
}

function saveFormData(string $name = '') {
    if (empty($_GET)) {
        return false;
    }

    $formData = $_GET;

    foreach ($formData as &$fieldData) {
        $fieldData = sanitizeData($fieldData);
    }

    if (!empty($errors = validateUserFormData($formData))) {
        return $errors;
    }

    unset($formData['password_repeat']);
    $formData['password'] = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
    $id = rand(1, 9999);

    if (empty($name)) {
        // SOHA nem hozunk létre dinamikusan fájlokat input mezőre hagyatkozva, ez most kivétel!
        $name = sprintf('%s_%s.json', $id, $formData['username']);
    }

    $path = sprintf('%s/%s', SUBMITTED_DATA_DIR, $name);
    file_put_contents($path, json_encode($formData));
    redirect('/login');
}

function sanitizeData(string|int $data) {
    return strip_tags($data);
}

function validateUserFormData(array $formData) {
    $errors = [];
    $addressPattern = '/^[a-zA-ZíÍáÁéÉúÚűŰóÓöÖ]+\,?\s?[a-zA-ZíÍáÁéÉúÚűŰóÓöÖ0-9]+$/';

    foreach ($formData as $key => $fieldData) {
        switch($key) {
            case 'email':
                if (!preg_match('/^[a-zA-Z_0-9]+\@[a-zA-Z0-9]+\.[a-zA-Z]+$/', $fieldData)) {
                    $errors[$key] = 'Helytelen e-mail cím';
                }
            break;
            case 'username':
                if (strlen($fieldData) <= 6) {
                    $errors[$key] = 'Túl rövid a felhasználónév';
                }
            break;
            case 'password':
            case 'password_repeat':
                if (!preg_match('/^[a-zA-Z_\-0-9$\|íÍáÁéÉúÚűŰóÓöÖ]{4,24}$/', $fieldData)) {
                    $errors[$key] = 'A jelszó formátuma nem megfelelő';
                }
            break;
            case 'country_and_city':
            case 'address':
                if (!preg_match($addressPattern, $fieldData)) {
                    $errors[$key] = 'A cím formátuma nem megfelelő';
                }
            break;
        }

        /*
        if ($key === 'email' && !preg_match('/^[a-zA-Z_0-9]+\@[a-zA-Z0-9]+\.[a-zA-Z]+$/', $fieldData)) {
            $errors[$key] = 'Helytelen e-mail cím';
        } else if ($key === 'username' && strlen($fieldData) <= 6) {
            $errors[$key] = 'Túl rövid a felhasználónév';
        } else if ($key === 'password' && !preg_match('/^[a-zA-Z_\-0-9$\|íÍáÁéÉúÚűŰóÓöÖ]{4,24}$/', $fieldData)) {
            $errors[$key] = 'Rossz a jelszó';
        } else if ($key === 'country_and_city' && !preg_match($addressPattern, $fieldData)) {
            $errors[$key] = 'Az ország vagy város formátuma nem megfelelő';
        } else if ($key === 'address' && !preg_match($addressPattern, $fieldData)) {
            $errors[$key] = 'A cím formátuma nem megfelelő';
        }
        */
    }

    if (empty($errors) && $_GET['password'] !== $_GET['password_repeat']) {
        $errors['password_repeat'] = 'A jelszavak nem egyeznek!';
    }

    return $errors;
}

function getUserData() {
    $files = array_diff(scandir(SUBMITTED_DATA_DIR), array('..', '.'));
    $data = [];

    foreach($files as $fileName) {
        $path = sprintf('%s/%s', SUBMITTED_DATA_DIR, $fileName);
        $data[] = json_decode(file_get_contents($path), true);
    }

    return $data;
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
