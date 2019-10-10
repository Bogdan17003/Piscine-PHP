<?php
    class UnholyFactory {
        private $_arr = array();

        public function absorb($class) {
            if (!($class instanceof Fighter))
                print ("(Factory can't absorb this, it's not a fighter)\n");
            else if (array_key_exists($class->getArmy(), $this->_arr))
                print ("(Factory already absorbed a fighter of type " . $class->getArmy() . ")\n");
            else {
                $this->_arr[$class->getArmy()] = $class;
                print ("(Factory absorbed a fighter of type " . $class->getArmy() . ")\n");
            }
        }

        public function fabricate($army) {
            if (array_key_exists($army, $this->_arr)) {
                print ("(Factory fabricates a fighter of type " . $army . ")\n");
                return ($this->_arr[$army]);
            }
            print "(Factory hasn't absorbed any fighter of type " . $army . ")\n";
            return(null);
        }
    }
?>