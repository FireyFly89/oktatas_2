<?php
// Integer
$integer = 1;
// Type juggling
// String
$string = "1";
// Bool
$bool = false;
// Null
$null = null;
// Float
$float = 0.34573454734585;
//$object = new std();
//$resource = new resource;

// Array (asszociatív / associatve)
$array = [
    'kulcs1' => 'szöveg1',
    'kulcs2' => 'szöveg2',
    'kulcs3' => [
        'kulcs3_3' => 'szöveg3',
        'kulcs3_4' => 'szöveg4',
    ]
];

$array2 = [
    'kulcs3' => 'szöveg3',
    'kulcs4' => 'szöveg4',
];

// Array (szimpla)
$array3 = ['valami1', 'valami2'];
// Ez itt a macska magasságát jelöli
$catHeight = 5;

// Szöveg "összefűzés, összeolvasztás"
$string1 = "valami " . $integer . " szöveg";
$string2 = "valami {$string} szöveg";
$string3 = "valami' {$string} 'szöveg";
$string4 = 'valami\' {$string} \'szöveg';
$string5 = "valami\" {$string} \"szöveg";

// A var_dump() függvény kiírja a változók típusát is
//pd(array_merge($array, $array2));
//pd($array2 + $array);
//dd($array + $array2);

//var_dump(array_merge($array, $array2));
//dd(1 <> 1);
// Null coalescing assignment operator (shorthand)
$test ??= $integer;
// falseish values: null, false, 0, minus integers, empty array ([], array())
// trueish values: true, 1, positive integers, arrays with at least one value

// Null coalescing operator (shorthand)
//var_dump($record ?? $default);

// Ternary operator
//$ternary = !is_null($test) ? $test : $variable === 1 ? $integer : $string;

// Modulo operator
//dd(5 % 2);

// Multiply
//var_dump(5 * 2);

// Divide
//var_dump(5 / 2);

//var_dump($ternary);
// bloc -> business logic
if (is_bool($bool) && !is_integer($integer) && is_string($string) || !is_integer($integer)) {
    //echo "<div style='padding: 6px 12px; background-color: black; color: white; font-weight: bold; font-size: 18px;'>IF</div>";
} elseif (is_bool($bool)) {
    //echo "<div style='padding: 6px 12px; background-color: red; color: white; font-weight: bold; font-size: 18px;'>ELSEIF</div>";
// Fallback
} else {
    //echo "<div style='padding: 6px 12px; background-color: #333; color: white; font-weight: bold; font-size: 18px;'>ELSE</div>";
}

$animal = "cat";

switch($animal) {
    case "cat":
        //echo "<div style='padding: 6px 12px; background-color: black; color: white; font-weight: bold; font-size: 18px;'>{$integer}</div>";
        break;
    case 2:
        //echo "<div style='padding: 6px 12px; background-color: black; color: white; font-weight: bold; font-size: 18px;'>{$integer}</div>";
        break;
    // Fallback
    default:
        echo "DEFAULT";
}

// Shorthand concatenation (concatenate)
$cat = "cat";
$catTail = " tail";
$cat = $cat . $catTail;
$cat .= $catTail;

$string1 = "teszt";
$string1 .= " valami";

// Shorthand addition
$int3 = 1;
$int4 = 5;
$int3 += $int4;

$int3 *= $int4;
$int = 0;
// Increment
$int++;

// Pre-increment
++$int;

// Decrement
$int--;

// Pre-Decrement
--$int;
// $int = $int - 1;
// $int -= 1;

$array3 = [
    0 => 'var1',
    1 => 'var2',
    2 => 'var3'
];

// $i = Iterrator, 10 hardcode-olt
for ($i = 0; $i <= 10; $i++) {
    //echo $i . "<br/>";
}

// Dinamikus kinyerése a tömb nagyságának/hosszának
for ($i = 0; $i <= (count($array3) - 1); $i++) {
    //echo $array3[$i] . "<br/>";
}

foreach($array3 as $key => $data) {
    //echo $data . "<br/>";
    //echo $array3[$key] . "<br/>";
}

$string = "abc";
 // Main Loop
while($string !== "abcab") {
    //echo $string;
    $string .= "ab";
}

$string = "abc";

do {
    //echo $string;
    $string .= "ab";
} while($string !== "abcab");

// Függvények rendelkeznek scope-okkal
// A függvényeknek átadott változókat Argument-nek hívják
function doSomething(string $cat, int $integer = 0) {
    var_dump($cat);
}

// Lambda function / Anonymous function
array_map(function($value) {
    //pd($value);
}, $array);

//doSomething($cat, $integer);
function makeLoop(int $integer) {
    //echo $integer;

    if ($integer < 5) {
        // Incremental integer
        //$integer += 1;
        //$integer = $integer + 1;
        makeLoop(++$integer);
    }
}
makeLoop(1);

$cats = [
    0 => [
        'type' => 'sziami',
        'hair' => [
            'color' => 'gray',
            'length' => 6
        ],
        'food' => ['szaraztap', 'konzerv']
    ]
];
//$cats = reset($cats);
//$cats = array_shift($cats);

$refInteger = 1;
$refString = 'test';

function referenceExample(int $refInteger, string &$refString) {
    $refInteger++;
    $refString .= ' fuggvenyben';
    return $refInteger;
}

$result = referenceExample($refInteger, $refString);

function getCatType($cat) {
    return $cat['type'];
}

function getCat(array $cat) {
    if ($cat['hair']['color'] !== 'gray' || $cat['type'] !== 'sziami') {
        return false;
    }

    if ($cat['type'] !== 'sziami') {
        return false;
    }

    if (!in_array('konzerv', $cat['food'])) {
        return false;
    }

    /*if ($cat['hair']['color'] === 'gray' && $cat['type'] === 'sziami') {
        if ($cat['type'] === 'sziami') {
            if (in_array('konzerv', $cat['food'])) {
                echo "megvan a cica";
            }
        }
    }*/

    echo "megvan a cica";
    return true;
}

// Plural ($cats)
//foreach ($cats as $cat) {
//    if (getCat($cat) === false) {
//        echo getCatType($cat);
//    }
//}

function pd(mixed $value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function dd(mixed $value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
