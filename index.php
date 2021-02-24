<?php

class WordsToNumbers
{
    const MIX = [
        'ty' => 1000000000,
        'trieu' => 1000000,
        'ngan' => 1000,
        'nghin' => 1000,
        'tram' => 100,
        'muoi' => 10,
        'chin' => 9,
        'tam' => 8,
        'bay' => 7,
        'sau' => 6,
        'nam' => 5,
        'lam' => 5,
        'bon' => 4,
        'tu' => 4,
        'ba' => 3,
        'hai' => 2,
        'mot' => 1,
        'khong' => 0,
    ];


    public function displayNumbers($words)
    {
        return $this->handle($words);
    }

    private function handle($words)
    {
        foreach (self::MIX as $word => $number) {
            $pattern = '/^(.*?)'. $word .'(.*?)$/';
            if(preg_match($pattern, $words, $matches)) {
                $totalPre = $this->handlePre($matches[1], $word);
                return $totalPre + $this->handle($matches[2]);
            }
        }

        return 0;
    }

    private function handlePre($words, $wordCurrent)
    {
        $mix = self::MIX;
        $checkWordInArrMix = 0;

        $arrExplode = explode(' ', $words);

        $arrExecute = [];
        foreach ($arrExplode as $key => $word) {
            if(isset($mix[$word])) {
                $checkWordInArrMix = 1;
                $arrExecute[] = $mix[$word];
            }
        }

        return $checkWordInArrMix ? $this->executeArray($arrExecute) * $mix[$wordCurrent] : $mix[$wordCurrent];
    }

    private function executeArray($arr)
    {
        $string = '$total = 0';

        foreach ($arr as $key => $value) {
            if(isset($arr[$key - 1])) {
                if($arr[$key - 1] >= 10 && $value >= 10) {
                    $string .= " + $value ";
                } elseif ($arr[$key - 1] < 10 && $value >= 10) {
                    $string .= " * $value ";
                } elseif ($value < 10) {
                    $string .= " + $value ";
                }
            } else {
                $string .= " + $value ";
            }
        }
        eval($string .';');

        return $total;
    }
}

// chin tram chin muoi chin trieu + chin tram chin muoi chin nghin chin tram chin muoi chin dong chan
// (9 * 100 + 9 * 10 + 9) * 1000000
// 999.000000
// 999999
// chin tram chin muoi chin nghin + chin tram chin muoi chin dong chan
// 9 100 9 10 9 1000 9 100 9 10 9
// (9 * 100 + 9 * 10 + 9) * 1000
// 999.000
// chin tram + chin muoi chin dong chan
// 9 * 100
// 900
// chin muoi chin dong chan
// 9 * 10
// chin dong chan
//

// mot nghin + khong tram linh chin dong chan
// 1 * 1000
// khong tram + linh chin dong chan
// 0 * 100
// linh chin dong chan
// 9

// mot tram muoi nghin + dong chan
// (1 * 100 + 10)* 1000
// 110000

// muoi mot nghin + dong chan
// (10 + 1) * 1000

// mot tram hai muoi nghin + dong chan
// (1 * 100 + 2 * 10) * 1000

