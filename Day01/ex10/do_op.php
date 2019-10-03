#!/usr/bin/php
<?php
if ($argc != 4)
    echo "Incorrect Parameters";
else {
    $a = trim($argv[1]);
    $b = trim($argv[3]);
    $sign = trim($argv[2]);
    if ($b == 0 && ($sign == "/" || $sign == "%"))
        echo "Division by zero!";
    else if ($sign == "+")
        echo $a + $b;
    else if ($sign == "-")
        echo $a - $b;
    else if ($sign == "/")
        echo $a / $b;
    else if ($sign == "*")
        echo $a * $b;
    else if ($sign == "%")
        echo $a % $b;
}
echo "\n";

?>