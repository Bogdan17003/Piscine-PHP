<?php

    function _error() {
        echo "ERROR\n";
        return ;
    }

    if (!$_POST['login'] === "" || $_POST['passwd'] === "" || $_POST['submit'] !== "OK")
        _error();
    if (!file_exists("../private") || !file_exists("../private/passwd"))
        mkdir("../private");
    if (file_exists("../private/passwd"))
        $arr = unserialize(file_get_contents("../private/passwd"));
    $tab['login'] = $_POST['login'];
    $tab['passwd'] = hash('whilpool', $_POST['passwd']);
    $arr[] = $tab;
    file_put_contents("../private/passwd", serialize($arr));
    echo "OK\n";
?>