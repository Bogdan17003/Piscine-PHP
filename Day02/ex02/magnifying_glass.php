#!/usr/bin/php
<?php

function upper($matches) {
    return ($matches[1]."".strtoupper($matches[2])."".$matches[3]);
}

if ($argc == 2) {
    $file = fopen($argv[1], 'r');
    while (!feof($file)) {
        $line = fgets($file);
        $line = preg_replace_callback("/(<a )(.*?)(>)(.*)(<\/a>)/si", function ($matches) {
            $matches[0] = preg_replace_callback("/(title=\")(.*?)(\")/mi", "upper", $matches[0]);
            $matches[0] = preg_replace_callback("/(>)(.*?)(<)/si", "upper", $matches[0]);
            return ($matches[0]);
        }, $line);
        echo $line;
    }
}
?>