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
}