<?php

// 467..114..
// ...*......
// ..35..633.
// ......#...
// 617*......
// .....+.58.
// ..592.....
// ......755.
// ...$.*....
// .664.598..
// In this schematic, two numbers are not part numbers because they are not adjacent to a symbol: 114 (top right) and 58 (middle right). Every other number is adjacent to a symbol and so is a part number; their sum is 4361.

class Solution
{

    public function run()
    {
        $valid_nums = range(0, 9);
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        // $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);

        $part_grid = self::setInputArray(
            $lines
        );
        // self::printArrayAsGrid($part_grid);

        $part_nums = [];
        $final_part_nums = [];
        $symbol_locations = [];
        foreach ($part_grid as $row_num => $row_items) {

            $cur_num = $cur_num_cords = "";
            foreach ($row_items as $col_num => $col_item) {

                if (in_array($col_item, $valid_nums)) {
                    $cur_num .= $col_item;
                    $cur_num_cords .= $row_num . "," . $col_num . ";";
                } else {

                    if ($col_item === "*") {
                        $symbol_locations[] = $row_num .",". $col_num;
                        $symbol_adjecent_store[$row_num .",". $col_num] = [];
                    }
                    if (strlen($cur_num)) {
                        $part_nums[$cur_num_cords] = $cur_num;
                    }
                    $cur_num = $cur_num_cords = "";
                }
            }
            if (strlen($cur_num)) {
                $part_nums[$cur_num_cords] = $cur_num;
            }
        }





        foreach ($part_nums as $part_cords => $part_num) {
            $cords = explode(";", trim($part_cords));
            $cords = array_filter($cords);

            $adjacent = [];
            // echo $part_num . " " .  $part_cords . PHP_EOL;
            foreach ($cords as $cord) {
                [
                    $y,
                    $x
                ] = explode(",", $cord);


                // y1,x1
                $adjacent = [
                    "w" => $y . "," . $x - 1,
                    "nw" => $y - 1 . "," . $x - 1,
                    "n" => $y - 1 . "," .$x,
                    "ne" => $y - 1 . "," .$x + 1,
                    "e" => $y . "," .$x + 1,
                    "se" => $y + 1 . "," .$x + 1,
                    "s" => $y + 1 . "," .$x,
                    "sw" => $y + 1 . "," .$x - 1,
                ];

                $intersects = array_intersect($symbol_locations, $adjacent);

                if(count($intersects)){
                    $intersect = array_keys(array_flip($intersects))[0];
                    $symbol_adjecent_store[$intersect][] = $part_num;
                }

            }
        }

        // print_r($symbol_locations);
        print_r($symbol_adjecent_store);
        // print_r($part_nums);

        $tot_gear_products = 0;
        foreach($symbol_adjecent_store as $adj_parts){

            $adj_parts = array_unique($adj_parts);

            if(count($adj_parts) == 2){
                $tot_gear_products += array_product($adj_parts);
            }
        }

        echo $tot_gear_products . PHP_EOL;

    }

    public function partOne()
    {
        $valid_nums = range(0, 9);
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        // $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);

        $part_grid = self::setInputArray(
            $lines
        );
        // self::printArrayAsGrid($part_grid);

        $part_nums = [];
        $final_part_nums = [];
        $symbol_locations = [];
        foreach ($part_grid as $row_num => $row_items) {

            $cur_num = $cur_num_cords = "";
            foreach ($row_items as $col_num => $col_item) {

                if (in_array($col_item, $valid_nums)) {
                    $cur_num .= $col_item;
                    $cur_num_cords .= $row_num . "," . $col_num . ";";
                } else {

                    if ($col_item !== ".") {
                        $symbol_locations[$row_num][$col_num] = $col_item;
                    }
                    if (strlen($cur_num)) {
                        $part_nums[$cur_num_cords] = $cur_num;
                    }
                    $cur_num = $cur_num_cords = "";
                }
            }
            if (strlen($cur_num)) {
                $part_nums[$cur_num_cords] = $cur_num;
            }
        }


        $line_sums = [];
        foreach ($part_nums as $part_cords => $part_num) {
            $cords = explode(";", trim($part_cords));
            $cords = array_filter($cords);

            $adjacent = [];
            // echo $part_num . " " .  $part_cords . PHP_EOL;
            foreach ($cords as $cord) {
                [
                    $y,
                    $x
                ] = explode(",", $cord);


                // y1,x1
                $adjacent = [
                    "w" => @$part_grid[$y][$x - 1],
                    "nw" => @$part_grid[$y - 1][$x - 1],
                    "n" => @$part_grid[$y - 1][$x],
                    "ne" => @$part_grid[$y - 1][$x + 1],
                    "e" => @$part_grid[$y][$x + 1],
                    "se" => @$part_grid[$y + 1][$x + 1],
                    "s" => @$part_grid[$y + 1][$x],
                    "sw" => @$part_grid[$y + 1][$x - 1],
                ];


                $adjacent = implode("", $adjacent);
                $adjacent = str_replace(".", "", $adjacent);
                $adjacent = preg_replace('/[0-9]+/', '', $adjacent);

                if($y == 40 ){
                    echo $part_num. PHP_EOL;
                }
                if(strlen($adjacent)){
                    $final_part_nums[] = $part_num;

                    @$line_sums[$y] += $part_num;
                    break 1;
                }



            }
        }

        foreach($line_sums as $k => $sum_line){
            if($sum_line !== self::SUM_CHECKS[$k]){
                echo "line: " . $k . " my_sum: " . $sum_line . " valid_sum: " . self::SUM_CHECKS[$k] . PHP_EOL;
            }
        }
        echo array_sum($final_part_nums);

    }
    private static function printArrayAsGrid($array)
    {

        echo PHP_EOL;
        foreach ($array as $row) {
            foreach ($row as $row_value) {
                echo $row_value;
            };

            echo PHP_EOL;
        }
    }

    private static function setInputArray($inputs)
    {
        $parts = [];
        foreach ($inputs as $index_key => $inputs) {
            $parts[$index_key] =  str_split($inputs);
        }
        return $parts;
    }

}

(new Solution())->run();
