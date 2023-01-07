<?php

$input = file_get_contents(__DIR__ . '/input.txt');
$lines = explode(PHP_EOL, $input);

$found = null;
foreach ($lines as $key => $value) {
    if (empty(trim($value))) {
        $found = $key;
        break;
    }
}

$stacks = array_slice($lines, 0, $found);
$orders = array_slice($lines, $found + 1, count($lines));

function getOrderValues(string $order): array
{
    preg_match_all('!\d+!', $order, $values);
    return end($values);
}

function getStackValues(array $stacks): array
{
    $columnString = end($stacks);
    $stackStrings = array_slice($stacks, 0, -1);
    $columnValues = getOrderValues($columnString);
    $columnIndices = array_map(fn($n) => strpos($columnString, $n), $columnValues);

    $stackArray = [];
    foreach ($stackStrings as $stack) {
        $key = 1;
        foreach ($columnIndices as $i) {
            if (!array_key_exists($key, $stackArray)) {
                $stackArray[$key] = [];
            }
            if (trim($stack[$i])) {
                $stackArray[$key][] = $stack[$i];
            }
            $key += 1;
        }
    }
    return $stackArray;
}

$answer1 = '';
$answer2 = '';
$stacksValues = getStackValues($stacks);
$stacksValues2 = getStackValues($stacks);
foreach ($orders as $order) {
    $orderValues = getOrderValues($order);

    list($move, $from, $to) = $orderValues;

    $toMove = array_splice($stacksValues[$from], 0, $move);
    array_unshift($stacksValues[$to], ...array_reverse($toMove));

    $toMove2 = array_splice($stacksValues2[$from], 0, $move);
    array_unshift($stacksValues2[$to], ...$toMove2);
}

foreach ($stacksValues as $stack) {
    $answer1 .= $stack[0];
}

foreach ($stacksValues2 as $stack) {
    $answer2 .= $stack[0];
}

echo "Answer 1 => " . $answer1 . PHP_EOL;
echo "Answer 2 => " . $answer2 . PHP_EOL;