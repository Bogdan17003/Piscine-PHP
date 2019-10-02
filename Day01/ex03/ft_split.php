
<?php

    function ft_split($str) {
        $word = preg_split("/ +/", trim($str));
        sort($word);
        if (!count($word) || !$word[0])
            return(NULL);
        return ($word);
    }
?>