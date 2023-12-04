<?php

class Calibration
{

    public function run()
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
