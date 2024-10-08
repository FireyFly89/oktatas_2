<?php
require(CLASSES_DIR . '/DatabaseManager.php');
require(CLASSES_DIR . '/Database.php');

class Model extends DatabaseManager implements Database {
    protected array $casts;
    protected string $tableName;

    public function __construct(int|null $id = null)
    {
        parent::__construct();

        if (is_int($id)) {
            $data = reset($this->read(['*'], ['id' => $id]));

            foreach($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

    public function create(array $columnsValues) {
        $columnNames = implode(',', array_keys($columnsValues));
        $columnNameValues = ':' . implode(',:', array_keys($columnsValues));
        $stmt = $this->connection->prepare("insert into $this->tableName ($columnNames) VALUES ($columnNameValues)");
        $result = $stmt->execute($columnsValues);

        if (!$result) {
            return $result;
        }

        return $this->connection->lastInsertId();
    }

    public function read(array $columns = ['*'], array $conditions = []) {
        $columnNames = implode(',', $columns);
        $conditionString = '';

        if (!empty($conditions)) {
            $conditionString = $this->assembleConditions($conditions);
        }
        
        $stmt = $this->connection->prepare("select $columnNames from $this->tableName $conditionString");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) === 1) {
            $result = reset($result);
        }

        return $result;
    }

    public function update(array $columnsValues, array $conditions) {
        $conditionString = $this->assembleConditions($conditions);
        $set = "set";
        $i = 1;
        
        foreach($columnsValues as $columnName => $value) {
            $set = sprintf("%s %s = '%s'", $set, $columnName, $value);

            if ($i < count($columnsValues)) {
                $set .= ',';
            }

            $i++;
        }

        $stmt = $this->connection->prepare("update $this->tableName $set $conditionString");
        return $stmt->execute();
    }

    public function delete(array $conditions) {
        $conditionString = $this->assembleConditions($conditions);
        $stmt = $this->connection->prepare("delete from $this->tableName $conditionString");
        return $stmt->execute();
    }

    protected function assembleConditions(array $conditions) {
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

    /**
     * Converts values based on the $casts variable
     *
     * @param  mixed $data
     * @return array
     */
    protected function castValues(array $data): array {
        foreach ($this->casts as $key => $cast) {
            if (array_key_exists($key, $data)) {
                if ($cast === 'encrypt') {
                    $data[$key] = password_hash($data[$key], PASSWORD_BCRYPT, ['cost' => 12]);
                }
            }
        }

        return $data;
    }
}