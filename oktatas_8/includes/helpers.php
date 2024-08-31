<?php
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

function requestFilterSimple(array $keys, array $data) {
    return array_map(function($key) use ($data) {
        return array_key_exists($key, $data) ? $data[$key] : false;
    }, $keys);
}

function requestFilter(array $keys, array $data) {
    return array_filter($data, function($key) use ($keys) {
        return in_array($key, $keys);
    }, ARRAY_FILTER_USE_KEY);
}
/*
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
}*/
