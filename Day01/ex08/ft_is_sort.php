<?php
function ft_is_sort($tab)
{
    $str = $tab;
    sort($str);
    if ($tab == $str)
        return (True);
    else
        return (False);
}
?>