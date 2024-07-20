<?php
require_once(CLASSES_DIR . '/FormController.php');

class UserFormController extends FormController {
    public static function save(array $data, array $definitions) {
        $errors = parent::validate($data, $definitions);

        if (!empty($errors)) {
            return $errors;
        }

        if ($errors === false) {
            return;
        }

        if (array_key_exists('password_repeat', $data)) {
            unset($data['password_repeat']);
        }

        $userData = requestFilter(['email', 'username', 'password'], $data);
        $user = new User();
        $userId = $user->create($userData);
        $userMetaData = requestFilter(['fullname', 'country_and_city', 'address'], $data);
        $user->createMeta($userMetaData, $userId);
        redirect('/login');
    }

    public static function login($data, $definitions) {
        $errors = parent::validate($data, $definitions);

        if (!empty($errors)) {
            return $errors;
        }

        if ($errors === false) {
            return;
        }

        $user = new User();
        $user = $user->getByEmail($data['email'], ['*']);
    
        if (!empty($user)) {
            $_SESSION['logged_in'] = $user;
        }
    }
}