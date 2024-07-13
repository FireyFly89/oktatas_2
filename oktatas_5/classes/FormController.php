<?php
class FormController {
    public static string $definitionName = '';

    public static function getDefinition(string $name) {
        $path = sprintf('%s/%sDefinition.json', DEFINITIONS_DIR, $name);
        self::$definitionName = $name;
        return json_decode(file_get_contents($path), true);
    }
    
    public static function getFieldValue(string|int $key) {
        if (empty($_GET) && !array_key_exists($key, $_GET)) {
            return '';
        }
    
        return $_GET[$key];
    }
    
    public static function saveFormData(array $data) {
        $errors = [];

        foreach ($data as &$fieldData) {
            $fieldData = sanitizeData($fieldData);
        }
    
        if (!empty($errors = self::validateUserFormData($data))) {
            return $errors;
        }

        if (array_key_exists('password_repeat', $data)) {
            unset($data['password_repeat']);
        }

        $user = new User();
        $userData = requestFilter(['email', 'username', 'password'], $data);
        $userId = $user->create($userData);
        $userMetaData = requestFilter(['fullname', 'country_and_city', 'address'], $data);
        $user->createMeta($userMetaData, $userId);
        redirect('/login');
    }

    private static function validateUserFormData(array $formData) {
        $errors = [];
    
        foreach ($formData as $key => $fieldData) {
            switch($key) {
                case 'email':
                    if (!preg_match('/^[a-zA-Z_0-9]+\@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/', $fieldData)) {
                        $errors[$key] = 'Helytelen e-mail cím';
                    }
    
                    /*if (!empty($dbManager->read('users', ['id'], ['email' => $fieldData]))) {
                        $errors[$key] = 'Már létezik ilyen e-mail cím';
                    }*/
                break;
                case 'username':
                    if (strlen($fieldData) <= 6) {
                        $errors[$key] = 'Túl rövid a felhasználónév';
                    }
                break;
                case 'fullname':
                    if (!empty($fieldData) && strlen($fieldData) <= 50 && strlen($fieldData) > 6) {
                        $errors[$key] = 'A teljes névnek minimum 6 és maximum 50 karakternek kell lennie';
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
                    if (!preg_match('/^[a-zA-ZíÍáÁéÉúÚűŰóÓöÖ]+\,?\s?[a-zA-ZíÍáÁéÉúÚűŰóÓöÖ0-9]+$/', $fieldData)) {
                        $errors[$key] = 'A cím formátuma nem megfelelő';
                    }
                break;
            }
        }
    
        if (empty($errors) && $_GET['password'] !== $_GET['password_repeat']) {
            $errors['password_repeat'] = 'A jelszavak nem egyeznek!';
        }
    
        return $errors;
    }
}