<?php
$data = file_get_contents('data.txt');

if (empty($data)) {
    echo "Data was empty!";
    exit;
}

$dataArray = explode(PHP_EOL, $data);
$columnNames = [];
$sortedArray = [];
$result = '';

foreach ($dataArray as $rowKey => $row) {
    $columns = explode('|', $row);
    $columnName = '';

    if (count($columns) <= 1) {
        continue;
    }

    $columns = array_filter($columns, function($value) {
        if (empty(trim($value))) {
            return false;
        }

        return true;
    });

    if ($rowKey === 1) {
        $columnNames = array_map(function($value) {
            return trim($value);
        }, $columns);
    }

    foreach ($columns as $columnKey => $column) {
        $columnName = trim($columnNames[$columnKey]);
        $columnData = trim($column);
        $columnData = str_replace('"', '""', $columnData);
        $sortedArray[$rowKey][$columnName] = $columnData;
    }

    $result .= '"' . implode('","', $sortedArray[$rowKey]) . "\"" . PHP_EOL;
}

file_put_contents('csvdata.csv', $result);

function pd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}