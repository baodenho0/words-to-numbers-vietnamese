<?php

require_once "numInWords.php";
require_once "index.php";

$number = rand(0, 9999999999);

//for ($i = 999999; $i <= 9999999; $i++) {
////    $i = 120000;
//    test($i);
//}

test($number);

function test($number)
{
    $words = strtolower(vn_to_str(numberInVietnameseCurrency($number)));

    $w = new WordsToNumbers;
    $convertNumber = $w->displayNumbers($words);

//    if ($number != $convertNumber) {
        echo 'number: ' . $number;
        echo "<br>";
        echo 'words: ' . $words;
        echo "<br>";
        echo 'error convertNumber: ' . $convertNumber;
        echo "<br>";
        echo "<hr>";
    if ($number == $convertNumber) {
        echo 'OKE';
    }
//    }

}


