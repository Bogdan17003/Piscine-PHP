#!/usr/bin/php
<?php

    if ($argv > 1) {
        $value = 0;
        $arr = array();
        while (++$value < $argc)
        {
            $word = preg_split("/ +/", trim($argv[$value]));
            if ($word)
                $arr = array_merge($arr, $word);
        }
        sort($arr);
        foreach ($arr as $word)
            echo "$word" . "\n";
    }
?>