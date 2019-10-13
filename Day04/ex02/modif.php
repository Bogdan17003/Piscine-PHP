<?php

function _exit() {
    echo "ERROR\n";
    exit();
}

if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] == "OK" && file_exists('../private') &&
    file_exists("../private/passwd")) {
    if (!$old_passwd = unserialize(file_get_contents("../private/passwd")))
        _exit();
    foreach ($old_passwd as $key => $value)
        if ($value['login'] === $_POST['login'] && $value['passwd'] == hash('whirlpool', $_POST['oldpw']))
        {
            $old_passwd[$key]['passwd'] = hash('whirlpool', $_POST['mewpw']);
            file_put_contents("../private/passwd", serialize($old_passwd));
            echo "OK\n";
            return ;
        }

}
_exit();

?>