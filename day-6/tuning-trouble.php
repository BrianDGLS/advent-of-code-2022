<?php

$input = file_get_contents(__DIR__ . '/input.txt');
$chars = str_split(trim($input));

function getFirstUniqueSet(array $chars, int $setLength): int
{
    for ($i = 0; $i < (count($chars) - $setLength); $i++) {
        $set = array_unique(array_slice($chars, $i, $setLength));
        if (count($set) == $setLength) {
            return $i + $setLength;
        }
    }
}

$answer1 = getFirstUniqueSet($chars, 4);
$answer2 = getFirstUniqueSet($chars, 14);

echo "Answer 1 => " . $answer1 . PHP_EOL;
echo "Answer 2 => " . $answer2 . PHP_EOL;