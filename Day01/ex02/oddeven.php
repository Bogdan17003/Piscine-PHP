#!/usr/bin/php
<?php
    $a=fopen("php://stdin", "r");
    while ($a && !feof($a)) {
        echo "Enter a number: ";
        $number = fgets($a);
        if ($number) {
            $number = str_replace("\n", "", $number);
            if (is_numeric($number)) {
                echo "The number " . $number . " is ";
                if ($number % 2 == 0)
                    echo "even\n";
                else
                    echo "odd\n";
            }
            else
                echo "'" . $number . "' is not a number\n";
        }
    }
    echo "\n";
?>