<?php

// Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53
// Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19
// Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1
// Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83
// Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36
// Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11
// In the above example, card 1 has five winning numbers (41, 48, 83, 86, and 17) and eight numbers you have (83, 86, 6, 31, 17, 9, 48, and 53). Of the numbers you have, four of them (48, 83, 17, and 86) are winning numbers! That means card 1 is worth 8 points (1 for the first match, then doubled three times for each of the three matches after the first).

// Card 2 has two winning numbers (32 and 61), so it is worth 2 points.
// Card 3 has two winning numbers (1 and 21), so it is worth 2 points.
// Card 4 has one winning number (84), so it is worth 1 point.
// Card 5 has no winning numbers, so it is worth no points.
// Card 6 has no winning numbers, so it is worth no points.
// So, in this example, the Elf's pile of scratchcards is worth 13 points.

// Take a seat in the large pile of colorful cards. How many points are they worth in total?

class Solution
{
    public function run()
    {
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        // $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);


        $winning_info = [];
        foreach ($lines as $k => $card) {
            $card = strstr($card, ': ');
            $card = ltrim($card, ": ");

            [
                $winning,
                $my_nums,
            ] = explode(" | ", $card);

            $my_nums = preg_replace('/\s+/', ' ', $my_nums);
            $winning = preg_replace('/\s+/', ' ', $winning);

            $winning = explode(" ", $winning);
            $my_nums = explode(" ", $my_nums);


            $winning_numbers = array_intersect($winning, $my_nums);
            if (count($winning_numbers)) {
                $winning_info[$k] = count($winning_numbers);
            }
        }

        $win_sum = 0;
        foreach ($winning_info as $card_num => $win_count) {
            $doubles = 1;
            for ($i = 1; $i < $win_count; $i++) {
                $doubles = $doubles * 2;
            }

            $win_sum += $doubles;
        }

        echo $win_sum;
    }
}

(new Solution())->run();
