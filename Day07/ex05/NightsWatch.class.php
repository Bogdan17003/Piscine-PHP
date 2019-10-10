<?php
    class NightsWatch {
        public function recruit($name) {
            if ($name instanceof IFighter)
                $name->fight();
        }

        public function fight() {}
    }
?>