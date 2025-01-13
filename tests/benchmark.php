<?php

ini_set('memory_limit', '512M');

$input = str_repeat('1001101001000110100000001', 100000); // Long string for the test

// Test with array_map
$start = microtime(true);
array_map(function ($char) {
    // Faz algo com $char
}, str_split($input));
$array_map_time = microtime(true) - $start;


// Test with simple string iteration in standard array
$start = microtime(true);
$standardArray = str_split($input);
foreach ($standardArray as $char) {
}
$simple_iteration_time = microtime(true) - $start;

// Test with ArrayIterator
$start = microtime(true);
$iterator = new ArrayIterator(str_split($input));
foreach ($iterator as $char) {
}
$array_iterator_time = microtime(true) - $start;

// Test with for loop
$start = microtime(true);
for ($i = 0, $len = strlen($input); $i < $len; $i++) {
}
$for_time = microtime(true) - $start;

// Results
echo "Arraymap: {$array_map_time} seconds\n";
echo "Simple Iteration: {$simple_iteration_time} seconds\n";
echo "ArrayIterator: {$array_iterator_time} seconds\n";
echo "For Loop: {$for_time} seconds\n";
