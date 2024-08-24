<?php
class DatabaseManager {
    protected $connection;

    // Konstruktor
    public function __construct(
        string $host = 'localhost',
        string $dbName = 'firstproject',
        string $dbUser = 'localuser',
        string $dbPass = 'localpass'
    ) {
        $this->connection = new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPass);
    }
}