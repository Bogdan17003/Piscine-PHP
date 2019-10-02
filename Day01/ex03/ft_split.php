
<?php

    function ft_split($str) {
        $words = preg_split("/ +/", trim($str));
        sort($words);
        if (!count($words) || !$words[0])
            return(NULL);
        return ($words);
    }
?>