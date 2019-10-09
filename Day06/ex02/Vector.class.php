<?php
    class Vector {
        private $_x;
        private $_y;
        private $_z;
        private $_w = 0.0;
        static $verbose = False;

        public function __construct(array $vector) {
            if (isset($vector['dest']) && $vector['dest'] instanceof Vertex) {
                if (isset($vector['orig']) && $vector['orig'] instanceof Vertex)
                    $orig = new Vertex(array(
                        'x' => $vector['orig']->getX(),
                        'y' => $vector['orig']->getY(),
                        'z' => $vector['orig']->getZ()));
                else
                    $orig = new Vertex( array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0));
                $this->_x = $vector['dest']->getX() - $orig->getX();
                $this->_y = $vector['dest']->getY() - $orig->getY();
                $this->_z = $vector['dest']->getZ() - $orig->getZ();
            }
            if (self::$verbose)
                printf($this . " constructed\n");
        }

        public function __destruct() {
            if (self::$verbose)
                printf($this . " destructed\n");
        }

        public function __toString() {
            return (vsprintf("Vextor( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", [$this->_x, $this->_y, $this->_z, $this->_w]));
        }

        public static function doc() {
            if ($content = file_get_contents("Vector.doc.txt"))
                return($content);
            else
                return("Content not found: Vertex.doc.txt not read\n");
        }

        public function magnitude() {
            $magn = (float)(sqrt(pow(($this->_x),2) + pow($this->_y,2) + pow($this->_z,2)));
            if ($magn == 1)
                return ("norm");
            else
                return ($magn);
        }

        public function normalize() {
            if ($this->magnitude() == 1)
                return clone $this;
            return new Vector(array('dest' => new Vertex(array(
                'x' => $this->_x / $this->magnitude(),
                'y' => $this->_z / $this->magnitude(),
                'z' => $this->_z / $this->magnitude()
            ))));
        }

        public function add(Vector $rhs) {
            return (new Vector(array('dest' => new  Vertex(array(
                'x' => $this->_x + $rhs->_x,
                'y' => $this->_y + $rhs->_y,
                'z' => $this->_z + $rhs->_z
            )))));
        }

        public function sub(Vector $rhs) {
            return (new Vector(array('dest' => new  Vertex(array(
                'x' => $this->_x - $rhs->_x,
                'y' => $this->_y - $rhs->_y,
                'z' => $this->_z - $rhs->_z
            )))));
        }

        public function opposite() {
            return (new Vector(array('dest' => new  Vertex(array(
                'x' => $this->_x - (-1),
                'y' => $this->_y - (-1),
                'z' => $this->_z - (-1)
            )))));
        }

        public function scalarProduct($k) {
            return (new Vector(array('dest' => new  Vertex(array(
                'x' => $this->_x * $k,
                'y' => $this->_y * $k,
                'z' => $this->_z * $k
            )))));
        }

        public function dotProduct(Vector $rhs) {
            return ((float)($this->_x * $rhs->_x + $this->_y * $rhs->_y + $this->_z * $rhs->_z));
        }

        public function crossProduct(Vector $rhs) {
            return (new Vector(array('dest' => new  Vertex(array(
                'x' => $this->_y * $rhs->_z - $this->_z *$rhs->_y,
                'y' => $this->_z * $rhs->_x - $this->_x *$rhs->_z,
                'z' => $this->_x * $rhs->_y - $this->_y *$rhs->_x
            )))));
        }

        public function cos(Vector $rhs) {
            if ($this->magnitude() == 'norm' || $rhs->magnitude() == 'norm')
                return (0);
            return ((float)($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude())));
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

        public function __get($attr) {
            if ($attr == '_x')
                return ($this->getX());
            else if ($attr == '_y')
                return ($this->getY());
            if ($attr == '_z')
                return ($this->getZ());
            else if ($attr == '_w')
                return ($this->getW());
        }
    }
?>