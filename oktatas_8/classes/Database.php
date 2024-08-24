<?php
Interface Database {
    public function create(array $columnsValues);
    public function read(array $columns = ['*'],  array $conditions = []);
    public function update(array $columnsValues, array $conditions);
    public function delete(array $conditions);
}