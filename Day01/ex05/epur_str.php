#!/usr/bin/php
<?php

    if ($argc > 1) {
        $text = $argv[1];
        $text = trim($text);
        $text = preg_replace("/ +/", " ", "$text");
        if ($text)
            echo $text . "\n";
    }
?>