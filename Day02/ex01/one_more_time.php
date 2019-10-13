#!/usr/bin/php
<?php
    function _exit() {
        echo "Wrong Format\n";
        exit(-1);
    }

    if ($argc == 2) {
        $check = 0;
        $str = ucwords($argv[1], " ");
        if (substr_count($str, " ") == 4)
            $arr = explode(" ", $str);
        else
            _exit();
        $day_week = array("Mon" => "Lundi", "Tue" => "Mardi", "Wed" => "Mercredi", "Thu" => "Jeudi",
            "Fri" => "Vendredi", "Sat" => "Samedi", "Sun" => "Dimanche");
        $month = array("1" => "Janvier", "2" => "Fevrier", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin",
            "7" => "Juillet", "8" => "Aout", "9" => "Septembre", "10" => "Octobre", "11" => "Novembre",
            "12" => "Decembre");
        if (in_array($arr[0], $day_week))
            $check++;
        if ((integer)$arr[1] > 0 && (integer)$arr[1] <= 32)
            $check++;
        if (in_array($arr[2], $month))
            $check++;
        if (preg_match("/^([0-9]){4}$/", $arr[3]) && $arr[3] > 1969)
            $check++;
        $time = explode(":", "$arr[4]");
        if (count($time) != 3)
            _exit();
        if ((preg_match("/^([0-9]){2}$/", $time[0]) && $time[0] >= 0 && $time[0] < 24) &&
            (preg_match("/^([0-9]){2}$/", $time[1]) && $time[1] >= 0 && $time[1] < 60) &&
            (preg_match("/^([0-9]){2}$/", $time[2]) && $time[2] >= 0 && $time[2] < 60))
            $check++;
        if (jddayofweek(cal_to_jd(CAL_GREGORIAN, array_search($arr[2], $month), $arr[1], $arr[3]), 2)
            == array_search($arr[0], $day_week))
            $check++;
        if ($check != 6)
            _exit();
        $input_time = strtotime($arr[3]."-".array_search($arr[2], $month)."-".$arr[1]." ".$arr[4]);
        $back_time = strtotime("1970-01-01 01:00:00");
        echo $input_time - $back_time."\n";
    }
?>