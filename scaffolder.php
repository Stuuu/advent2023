#!/usr/local/bin/php
<?php

// first arg is file name we can ignore it
array_shift($argv);

$input = implode("", $argv);
$dir = $input . "/";
mkdir($dir, 0777, true);
$file_name = "day_" . intval($input) . '.php';
$fh = fopen($dir . $file_name, "w") or die("Unable to open file");

$test_file = fopen($dir . 'test_puzzle_inputs.txt', "w") or die("Unable to open file");
fclose($test_file);

$input_file = fopen($dir . 'puzzle_inputs.txt', "w") or die("Unable to open file");
fclose($input_file);
$contents = <<<'END'
<?php

class Solution
{
    public function run()
    {
        $lines = file('puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
        $lines = file('test_puzzle_inputs.txt', FILE_IGNORE_NEW_LINES);
    }
}

(new Solution())->run();

END;
fwrite($fh, $contents);
fclose($fh);
