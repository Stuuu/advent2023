<?php

class Solution
{

    const MULTIPLIER = 17;
    const DIVISOR = 256;

    public function run()
    {
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        // $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);


        $steps = explode(",", $lines[0]);
        $step_sums = [];


        foreach ($steps as $k => $step_string) {
            $string_parts = str_split($step_string);
            $current_value = 0;
            foreach ($string_parts as $key => $char) {
                $current_value += ord($char);
                $current_value = $current_value * static::MULTIPLIER;
                $current_value = $current_value % static::DIVISOR;
            }
            $step_sums[] = $current_value;
        }

        return array_sum($step_sums);
    }
}

echo (new Solution())->run();
