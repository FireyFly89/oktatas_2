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

    public static function update(array $data, array $definitions) {
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

        $profileImage = requestFilter(['profile_img'], $data);
        $userData = requestFilter(['id', 'email', 'username', 'password'], $data);
        $user = new User();
        $result = $user->update($userData, ['id' => $userData['id']]);

        if (!$result) {
            return false;
        }

        $fileName = $userData['username'] . '.png';
        $filePathName = sprintf('%s/images/%s', PUBLIC_USERS_DIR, $fileName);
        $result = move_uploaded_file($profileImage['profile_img']['tmp_name'], $filePathName);

        if ($result) {
            $user->createMeta(['profile_img' => '/public/users/images/' . $fileName], $userData['id']);
        }

        $updatedData = $user->getByEmail($userData['email'], ['*']);
        $_SESSION['logged_in'] = $updatedData;

        if (!empty($userMetaData = requestFilter(['fullname', 'country_and_city', 'address'], $data))) {
            $user->createMeta($userMetaData, $userData['id']);
        }
        
        redirect('/profile/update');
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