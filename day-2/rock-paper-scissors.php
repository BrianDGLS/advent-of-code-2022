<?php

$input = file_get_contents(__DIR__ . '/input.txt');
$lines = explode(PHP_EOL, trim($input));

function getScore(string $opponent, string $player): int
{
    $opponentMoves = ["A", "B", "C"];
    $opponentChoice = array_search($opponent, $opponentMoves);

    $playerMoves = ["X", "Y", "Z"];
    $playerChoice = array_search($player, $playerMoves);

    $score = $playerChoice + 1;

    if ($playerChoice === $opponentChoice) {
        return $score + 3;
    }

    if ($playerChoice == array_search($opponent, ["C", "A", "B"])) {
        return $score + 6;
    }

    return $score;
}

function getCorrectPlayerMove(string $opponent, string $outcome): string
{
    $opponentMoves = ["A", "B", "C"];
    $opponentChoice = array_search($opponent, $opponentMoves);

    if ($outcome == "Z") {
        return ["Y", "Z", "X"][$opponentChoice];
    }

    if ($outcome == "X") {
        return ["Z", "X", "Y"][$opponentChoice];
    }

    return ["X", "Y", "Z"][$opponentChoice];
}

$answer1 = 0;
$answer2 = 0;
foreach ($lines as $line) {
    list($opponent, $player) = explode(" ", $line);
    $opponent = trim($opponent);
    $player = trim($player);
    $answer1 += getScore($opponent, $player);
    $answer2 += getScore($opponent, getCorrectPlayerMove($opponent, $player));
}

echo 'Answer 1 => ' . $answer1 . PHP_EOL;
echo 'Answer 2 => ' . $answer2 . PHP_EOL;
