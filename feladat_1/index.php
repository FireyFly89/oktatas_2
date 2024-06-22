<?php
$source = ['valami', 'szövegek', 'még egy érték', 'valami új érték már megint'];
/*$fileData = "";

foreach($source as $key => $data) {
    $fileData .= $data;

    if ($key < count($source) - 1) {
        $fileData .= PHP_EOL;
    }
}

$test = "ez itt egy teszt string";

echo "<pre>";
var_dump(explode(' ', $test));
echo "</pre>";*/
file_put_contents('szoveg', implode(PHP_EOL, $source));