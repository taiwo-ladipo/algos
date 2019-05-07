<?php

function generateRap()
{
    $alienWords = [
        'CODEJAM',
        'ALPHABET',
        'JET',
        'BET',
        'SET',
        'JAM',
        'HAM',
        'NALAM',
        'HUM',
        'NOLOM'
    ];
    $alienWords = [
        'PI',
        'HI',
        'WI',
        'FI',
        'SKI',
        "JETSKI"
    ];

    $score = 0;

    $sorted = sortByLastChar($alienWords);
    foreach ($sorted as $matches) {
        $matchedLines = [];
        $rhymes = [];
        foreach ($matches as $key => $value) {
            if (in_array($value, $matchedLines)) {
                continue;
            }
            for ($i = strlen($value); $i > 0; $i--) {
                foreach ($matches as $index => $val) {
                    $subStr = substr($value, strlen($value) - $i);

                    if (in_array($subStr, $matchedLines) ||
                        in_array($value, $matchedLines) ||
                        in_array($val, $matchedLines) ||
                        $index == $key) {
                        continue;
                    }

                    if ($subStr == substr($val, -strlen($subStr))) {
                        $score += 2;
                        array_push($matchedLines, $value, $val, $subStr);
                        array_push($rhymes, $subStr, substr($val, -strlen($subStr)));
                    }
                }
            }
        }
        var_dump($matchedLines);
        var_dump($rhymes);
        var_dump('score: ' . $score);
    }
    return $score;
}

function sortByLastChar($lines)
{
    $usedChars = [];
    $sorted = [];

    foreach ($lines as $line) {
        $lastChar = substr($line, -1);
        if (in_array($lastChar, $usedChars)) {
            continue;
        }
        $matches = array_filter(
            $lines,
            function ($value) use ($lastChar) {
                return substr($value, -1) == $lastChar;
            }
        );
        //Sort by word length. Longest first
        usort($matches, function ($a, $b) {
            return strlen($b) - strlen($a);
        });
        $sorted[$lastChar] = $matches;
    }
    return $sorted;
}

generateRap();