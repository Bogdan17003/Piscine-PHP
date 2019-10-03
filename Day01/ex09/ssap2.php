#!/usr/bin/php
<?php
function cmp($a, $b)
{
    $i = 0;
    $line = "abcdefghijklmnopqrstuvwxyz0123456789!#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
    while (($i < strlen($a)) || ($i < strlen($b)))
    {
        $a_index = stripos($line, $a[$i]);
        $b_index = stripos($line, $b[$i]);
        if ($a_index > $b_index)
            return (1);
        else if ($a_index < $b_index)
            return (-1);
        else
            $i++;
    }
}
$arg = 1;
$arr = array();
foreach ($argv as $word)
{
    if ($arg++ > 1)
    {
        $temp = preg_split("/ +/", trim($word));
        if ($temp[0])
            $arr = array_merge($arr, $temp);
    }
}
usort($arr, "cmp");
foreach ($arr as $word)
    echo "$word"."\n";
?>