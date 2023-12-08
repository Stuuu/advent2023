<?php

class Solution
{
    public function run()
    {
        ini_set('memory_limit','2048M');
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        // $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);

        $races = [];
        foreach ($lines as $line_num => $line) {
            $line = preg_replace('/\s+/', ' ', $line);
            $line = explode(' ', $line);

            $line = array_slice($line, 1);
            $value = implode("", $line);

            $races[1][] = $value;
        }

        $win_counts_by_race = [];
        foreach ($races as $race_num => $vals) {
            $time = $vals[0];
            $record_distance = $vals[1];
            $races[$race_num]['win_count'] = 0;


            foreach (range(0, $time) as $increment) {

                $inc_dist = ($increment * ($time - $increment));

                if ($inc_dist > $record_distance) {
                    $races[$race_num]['win_count']++;
                }
            }

            $win_counts_by_race[$race_num] = $races[$race_num]['win_count'];
        }

        echo array_product($win_counts_by_race) . PHP_EOL;
        die;
    }
}

(new Solution())->run();
