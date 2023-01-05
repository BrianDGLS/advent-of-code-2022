<?php

$input = file_get_contents(__DIR__ . '/input.txt');
$lines = explode(PHP_EOL, trim($input));

function getAssignments(string $line): array
{
    return array_map(
        fn($line) => explode('-', $line),
        explode(',', $line));
}

function isContained(array $left, array $right): bool
{
    return $right[0] <= $left[1] && $right[1] <= $left[1];
}

function isOverlap(array $left, array $right): bool
{
    return $left[0] <= $right[1] && $right[0] <= $left[1];
}

$answer1 = 0;
$answer2 = 0;
foreach (array_map(fn($s) => trim($s), $lines) as $line) {
    list($left, $right) = getAssignments($line);
    $answer1 += isContained($left, $right) ? 1 : 0;
    $answer2 += isOverlap($left, $right) ? 1 : 0;
}

echo "Answer 1 => " . $answer1 . PHP_EOL;
echo "Answer 2 => " . $answer2 . PHP_EOL;
