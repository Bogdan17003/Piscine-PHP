<?php
    abstract class Fighter {
        private $_value;

        public function __construct($value) {
            $this->_value = $value;
        }

        public function getArmy() {
            return $this->_value;
        }

        abstract function fight($target);
    }
?>