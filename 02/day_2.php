<?php

class Solution
{
    const CUBES = [
        'red' => 0,
        'green' => 0,
        'blue' => 0,
    ];
    public function run()
    {
        // put commands into an array
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        // $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);


        $sum = 0;
        foreach ($lines as $game_num => $line) {
            // Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
            $line = substr($line, strpos($line, ":") + 1);
            $line_parts = explode(";", $line);
            $mins_for_set = [
                'red' => 0,
                'green' => 0,
                'blue' => 0,
            ];
            foreach ($line_parts as $set_num => $set) {
                $set_parts = explode(",", $set);

                foreach ($set_parts as $key => $vals) {



                    [
                        $count,
                        $color,
                    ] = explode(" ", trim($vals));

                    if($set_num === 0){
                        $mins_for_set[$color] = $count;
                    }

                     if($count > $mins_for_set[$color]){
                        $mins_for_set[$color] = $count;
                     }

                }
            }
            $sum += array_product($mins_for_set);
        }

        echo $sum . PHP_EOL;



        // The power of a set of cubes is equal to the numbers of red, green, and blue cubes multiplied together. The power of the minimum set of cubes in game 1 is 48. In games 2-5 it was 12, 1560, 630, and 36, respectively. Adding up these five powers produces the sum 2286.
    }

    public function partOne()
    {
        // put commands into an array
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        // $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        $total_games = array_flip(range(1, count($lines)));

        print_r($total_games);

        $possible = [];
        foreach ($lines as $game_num => $line) {
            // Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
            $line = substr($line, strpos($line, ":") + 1);
            $line_parts = explode(";", $line);
            foreach ($line_parts as $set) {
                $set_parts = explode(",", $set);

                foreach ($set_parts as $key => $vals) {
                    [
                        $count,
                        $color,
                    ] = explode(" ", trim($vals));

                    if ($count > self::CUBES[$color]) {
                        echo 'game: ' . ($game_num + 1) . ' ' . 'impossible ' . $color . " : " . $count . PHP_EOL;
                        unset($total_games[$game_num +1]);
                        break 2;
                    }
                }
                $possible[] = ($game_num + 1);
            }
        }

        echo array_sum(array_keys($total_games));
        // print_r($possible);
        die;


        // 1, 2, and 5 would have been possible if the bag had been loaded with that configuration
        // return sum of game number counts 8 for test
    }
}

(new Solution())->run();
