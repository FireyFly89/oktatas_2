<?php
require_once('Model.php');
require(TRAITS_DIR . '/metaData.php');

// MVC struktúra jellegű kialakítás
class User extends Model {
    use metaData;

    protected string $tableName = 'users';

    protected array $fillables = [
        'email',
        'username',
        'password',
    ];

    protected array $casts = [
        'password' => 'encrypt'
    ];
    
    /**
     * Creates a new user record
     *
     * @param  mixed $data
     * @return string
     */
    public function create(array $data, string $tableName = ''): string|false {
        $data = parent::castValues($data);
        return parent::create($data, $this->tableName);
    }

    public function getByEmail(string $email, array $columns = ['id']) {
        return $this->read($columns, ['email' => $email]);
    }

    public function verifyPassword(string $email, string $password) {
        $user = $this->read(['password'], ['email' => $email]);
        return password_verify($password, $user['password']);
    }

    public function logout() {
        $_SESSION['logged_in'] = null;
    }
}