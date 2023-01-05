<?php

$input = file_get_contents(__DIR__ . '/input.txt');
$lines = explode(PHP_EOL, trim($input));

function halveString(string $s): array
{
    return str_split($s, strlen($s) / 2);
}

function getCommonCharacters(array $strings): array
{
    $charArray = array_map(fn($s) => str_split($s), $strings);
    return array_unique(array_intersect(...$charArray));
}

function sumCharacterValues(array $a): int
{
    $alphabet = array_merge(range('a', 'z'), range('A', 'Z'));
    return array_reduce($a,
        fn(int $acc, string $c) => $acc + array_search($c, $alphabet) + 1,
        0);
}

$answer1 = 0;
foreach ($lines as $group) {
    $commonCharacters = getCommonCharacters(halveString(trim($group)));
    $answer1 += sumCharacterValues($commonCharacters);
}

$answer2 = 0;
foreach (array_chunk($lines, 3) as $group) {
    $trimmedGroup = array_map(fn($s) => trim($s), $group);
    $commonCharacters = getCommonCharacters($trimmedGroup);
    $answer2 += sumCharacterValues($commonCharacters);
}

echo "Answer 1 => " . $answer1 . PHP_EOL;
echo "Answer 2 => " . $answer2 . PHP_EOL;
