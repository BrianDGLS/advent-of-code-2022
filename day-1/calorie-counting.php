<?php

$input = file_get_contents(__DIR__ . '/input.txt');
$lines = explode(PHP_EOL, $input);

$current = 0;
$calories = [];
foreach ($lines as $line) {
    if (strlen(trim($line)) == 0) {
        $calories[] = $current;
        $current = 0;
    } else {
        $current += (int)$line;
    }
}

sort($calories);

$answer1 = end($calories);
$answer2 = array_sum(array_slice($calories, -3));

echo 'Answer 1 => ' . $answer1 . PHP_EOL;
echo 'Answer 2 => ' . $answer2 . PHP_EOL;
