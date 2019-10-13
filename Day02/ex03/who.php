#!/usr/bin/php
<?php
    if (file_exists("/var/run/utmpx"))
    {
        date_default_timezone_set("Europe/Kiev");
        $file = fopen("/var/run/utmpx", "r");
        $users = array();
        while ($str = fread($file, 628)) {
            $str = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $str);
            $users[$str['line']] = $str;
        }
        ksort($users);
        foreach ($users as $line) {
            if ($line['type'] == 7) {
                echo str_pad(substr(trim($line['user']), 0, 8), 8, " ")." ";
                echo str_pad(substr(trim($line['line']), 0, 8), 8, " ")." ";
                echo date("M", $line["time1"]);
                echo str_pad(date("j", $line["time1"]), 3, " ", STR_PAD_LEFT)." ".
                    date("H:i", $line["time1"]);
                echo "\n";
            }
        }
    }

?>