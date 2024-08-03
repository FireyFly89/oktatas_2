<?php
function init() {
    if (!array_key_exists('position', $_SESSION)) {
        $_SESSION['position'] = 1;
    }

    if (!array_key_exists('positionKincs', $_SESSION)) {
        generateTreasures();
    }

    if (!isset($_SESSION['result']) && !isset($_SESSION['circle'])) {
        $_SESSION['result'] = 0;
        $_SESSION['circle'] = 0;
    }
}

function roll($kocka)
{
    $randomIndex = array_rand($kocka);
    $_SESSION['position'] += $randomIndex;
    $_SESSION['dice'] = $randomIndex;

    if (array_key_exists('positionKincs', $_SESSION) && in_array($_SESSION['position'], $_SESSION['positionKincs'])) {
        $_SESSION['result']++;
    }

    return $randomIndex;
}

function restart() {
    $_SESSION['position'] = 1;
    $_SESSION['result'] = 0;
    $_SESSION['circle'] = 0;
    generateTreasures();
}

function endLoop($maxFields) {
    $_SESSION['position'] = $_SESSION['position'] % $maxFields;
    $_SESSION['circle']++;
    generateTreasures();
}

function generateTreasures() {
    $numbers = range(2, 59); // egy tömböt hozunk létre 2-59-ig
    $positionKincs = array_rand(array_flip($numbers), 3); // 3 számot választ ki
    $_SESSION['positionKincs'] = $positionKincs;
}