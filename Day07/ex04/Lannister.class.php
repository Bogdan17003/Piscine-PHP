<?php
    class Lannister {
        public function sleepWith($name) {
            if ($name instanceof Lannister)
                print ("Not even if I'm drunk !\n");
            else
                print ("Let's do this.\n");
        }
    }
?>