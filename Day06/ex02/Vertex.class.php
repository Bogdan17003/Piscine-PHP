<?php
    class Vertex {
        private $_x;
        private $_y;
        private $_z;
        private $_w = 1.0;
        private $_color;
        static $verbose = False;

        public function __construct(array $_x_y_z_w_c) {
            if (isset($_x_y_z_w_c['w']))
                $this->_w = $_x_y_z_w_c['w'];
            if (isset($_x_y_z_w_c['color']))
                $this->_color = $_x_y_z_w_c['color'];
            else
                $this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
            if (isset($_x_y_z_w_c['x']) && isset($_x_y_z_w_c['y']) && isset($_x_y_z_w_c['z'])) {
                $this->_x = $_x_y_z_w_c['x'];
                $this->_y = $_x_y_z_w_c['y'];
                $this->_z = $_x_y_z_w_c['z'];
            }
            if (self::$verbose)
                printf($this . " constructed\n");
        }

        public function __destruct() {
            if (self::$verbose) {
                printf($this . " destructed\n");
            }
        }

        public function __toString() {
            if (self::$verbose)
                return (vsprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s)",
                    [$this->_x, $this->_y, $this->_z, $this->_w, $this->_color]));
            else
                return (vsprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
                    [$this->_x, $this->_y, $this->_z, $this->_w]));
        }

        public static function doc() {
            if ($content = file_get_contents("Vertex.doc.txt"))
               return($content);
            else
                return("Content not found: Vertex.doc.txt not read\n");
        }

        public function getX() {
            return $this->_x;
        }

        public function getY() {
            return $this->_y;
        }

        public function getZ() {
            return $this->_z;
        }

        public function getW() {
            return $this->_w;
        }

        public function getColor() {
            return $this->_color;
        }

        public function setX($x) {
            $this->_x = $x;
        }

        public function setY($y) {
            $this->_y = $y;
        }

        public function setZ($z) {
            $this->_z = $z;
        }

        public function setW($w) {
            $this->_w = $w;
        }

        public function setColor($color) {
            $this->_color = $color;
        }

    }
?>