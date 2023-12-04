<?php

class Calibration
{

    const WORD_NUMS = [
        "one" => 1,
        "two" => 2,
        "three" => 3,
        "four" => 4,
        "five" => 5,
        "six" => 6,
        "seven" => 7,
        "eight" => 8,
        "nine" => 9,
    ];

    public function run()
    {
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);

        $vals = [];
        foreach ($lines as $key => $line) {
            $line_parts = str_split($line);
            $nums_in_line = [];
            foreach ($line_parts as $line_position => $char) {
                if (intval($char)) {
                    $nums_in_line[$line_position] = $char;
                }
            }

            foreach(self::WORD_NUMS as $char_version => $int_val){
                $lastPos = 0;
                $positions = [];
                while (($lastPos = strpos($line, $char_version, $lastPos)) !== false) {
                    $positions[] = $lastPos;
                    $nums_in_line[$lastPos] = $int_val;
                    $lastPos = $lastPos + strlen($char_version);
                }
            }

            $keys = array_keys($nums_in_line);

            $first_key = min($keys);
            $last_key = max($keys);

            $vals[] = $nums_in_line[$first_key] . $nums_in_line[$last_key];
        }

        print_r(array_sum($vals));

    }

    public function partOne()
    {
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);


        $vals = [];
        foreach ($lines as $key => $value) {
            preg_match_all('!\d+!', $value, $matches);

            $first = @array_shift(array_values($matches[0]));
            $last = end($matches[0]);

            $two_dig = substr($first, 0, 1) . substr($last, -1);

            $vals[] = $two_dig;
        }

        print_r($vals);
        echo array_sum($vals);
    }
}

(new Calibration())->run();
