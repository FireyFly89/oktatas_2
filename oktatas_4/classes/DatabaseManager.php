<?php
class DatabaseManager {
    private $connection;

    // Konstruktor
    public function __construct(
        string $host = 'localhost',
        string $dbName = 'firstproject',
        string $dbUser = 'localuser',
        string $dbPass = 'localpass'
    ) {
        $this->connection = new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPass);
    }

    public function create(string $tableName, array $columnsValues) {
        $columnNames = implode(',', array_keys($columnsValues));
        $columnNameValues = ':' . implode(',:', array_keys($columnsValues));
        $stmt = $this->connection->prepare("insert into $tableName ($columnNames) VALUES ($columnNameValues)");
        return $stmt->execute($columnsValues);
    }

    public function read(string $tableName, array $columns = ['*'],  array $conditions = []) {
        $columnNames = implode(',', $columns);
        $conditionString = '';

        if (!empty($conditions)) {
            $conditionString = $this->assembleConditions($conditions);
        }

        $stmt = $this->connection->prepare("select $columnNames from $tableName $conditionString");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update(string $tableName, array $columnsValues, array $conditions) {
        $conditionString = $this->assembleConditions($conditions);
        $set = "set";
        
        foreach($columnsValues as $columnName => $value) {
            $set = sprintf("%s %s = '%s'", $set, $columnName, $value);
        }

        $stmt = $this->connection->prepare("update $tableName $set $conditionString");
        return $stmt->execute();
    }

    public function delete(string $tableName, array $conditions) {
        $conditionString = $this->assembleConditions($conditions);
        $stmt = $this->connection->prepare("delete from $tableName $conditionString");
        return $stmt->execute();
    }

    private function assembleConditions(array $conditions) {
        $conditionString = 'where';
        $i = 0;

        foreach($conditions as $conditionKey => $condition) {
            if ($i > 0) {
                $conditionString .= ' and';
            }

            $conditionString .= sprintf(" %s = '%s'", $conditionKey, $condition);
            $i++;
        }

        return $conditionString;
    }
}