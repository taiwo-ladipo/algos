<?php

const TENS_MAP = [
    '0' => '',
    '1' => 'one',
    '2' => 'two',
    '3' => 'three',
    '4' => 'four',
    '5' => 'five',
    '6' => 'six',
    '7' => 'seven',
    '8' => 'eight',
    '9' => 'nine',
    '10' => 'ten',
    '11' => 'eleven',
    '12' => 'twelve',
    '13' => 'thirteen',
    '14' => 'fourteen',
    '15' => 'fifteen',
    '16' => 'sixteen',
    '17' => 'seventeen',
    '18' => 'eighteen',
    '19' => 'nineteen'
];
function convertToWords($num, $prefix = '')
{
    switch ($num) {
        case $num > 0 && $num <= 19:
            $str = TENS_MAP[$num];
            break;

        case $num > 19 && $num <= 29:
            $str = getBoundaryNumbers('twenty ', 20, $num);
            break;
        case $num > 29 && $num <= 39:
            $str = getBoundaryNumbers('thirty ', 30, $num);
            break;
        case $num > 39 && $num <= 49:
            $str = getBoundaryNumbers('forty ', 40, $num);
            break;
        case $num > 49 && $num <= 59:
            $str = getBoundaryNumbers('fifty ', 50, $num);
            break;
        case $num > 59 && $num <= 69:
            $str = getBoundaryNumbers('sixty ', 60, $num);
            break;
        case $num > 69 && $num <= 79:
            $str = getBoundaryNumbers('seventy ', 70, $num);
            break;
        case $num > 79 && $num <= 89:
            $str = getBoundaryNumbers('eighty ', 80, $num);
            break;
        case $num > 89 && $num <= 99:
            $str = getBoundaryNumbers('ninety ', 90, $num);
            break;
        case $num > 99:
            $base = floor($num / 100);
            $glue = ', ';

            if (strlen($base) <= 1) {
                $str = TENS_MAP[$base] . ' hundred ';
                $remainder = $num % 100;
                $glue = 'and';
            } elseif (strlen($base) <= 4) {
                $str = convertToWords(floor($base/10)) . ' thousand ';
                $remainder = $num % 1000;
            } elseif (strlen($base) <= 7) {
                $str = convertToWords(floor($base/10000)) . ' million ';
                $remainder = $num % 1000000;
            } elseif (strlen($base) >= 7) {
                $str = convertToWords(floor($base/10000000)) . ' billion ';
                $remainder = $num % 1000000000;
            }

            if ($remainder) {
                $str = convertToWords($remainder, $str . $glue);
            }

            break;
        default:
            $str = 'Not available';
            break;
    }
    return $prefix . ' ' . $str;
}

function getBoundaryNumbers($baseStr, $baseNum, $num)
{
    $num = $num - $baseNum;
    $str = $baseStr  . convertToWords($num);
    return $str;
}

echo convertToWords(101978);
