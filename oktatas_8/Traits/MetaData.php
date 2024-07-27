<?php
trait MetaData {
    public function createMeta(array $columnsValues, int $relationId) {
        $queryString = '';
        $tableNameSingular = substr($this->tableName, 0, -1);

        for ($i = 0; $i < count($columnsValues); $i++) {
            $queryString .= "insert into {$this->tableName}_meta ({$tableNameSingular}_id, meta_key, meta_value) VALUES ($relationId, :meta_key{$i}, :meta_value{$i});";
        }

        $stmt = $this->connection->prepare($queryString);

        $i = 0;
        foreach ($columnsValues as $columnName => $columnValue) {
            $stmt->bindValue("meta_key{$i}", $columnName, PDO::PARAM_STR);
            $stmt->bindValue("meta_value{$i}", $columnValue, PDO::PARAM_STR);
            $i++;
        }

        return $stmt->execute();
    }

    protected function readMeta(array $columns = ['*'],  array $conditions = [], $tableName) {
        $columnNames = implode(',', $columns);
        $conditionString = '';

        if (!empty($conditions)) {
            $conditionString = $this->assembleConditions($conditions);
        }
        
        $stmt = $this->connection->prepare("select $columnNames from $tableName $conditionString");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) === 1) {
            $result = reset($result);
        }

        return $result;
    }
}