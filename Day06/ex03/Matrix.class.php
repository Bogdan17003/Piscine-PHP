<?php

    class Matrix {
        const IDENTITY = "IDENTITY";
        const SCALE = "SCALE";
        const RX = "Ox ROTATION";
        const RY = "Oy ROTATION";
        const RZ = "Oz ROTATION";
        const TRANSLATION = "TRANSLATION";
        const PROJECTION = "PROJECTION";

        protected $_matrix = array();
        private $_preset;
        private $_scale;
        private $_angle;
        private $_vtc;
        private $_fov;
        private $_ratio;
        private $_near;
        private $_far;

        static $verbose = False;

        public function __construct($array) {
            if (isset($array)) {
                if (isset($array['preset']))
                    $this->_preset = $array['preset'];
                if (isset($array['scale']))
                    $this->_scale = $array['scale'];
                if (isset($array['angle']))
                    $this->_angle = $array['angle'];
                if (isset($array['vtc']))
                    $this->_vtc = $array['vtc'];
                if (isset($array['fov']))
                    $this->_fov = $array['fov'];
                if (isset($array['ratio']))
                    $this->_ratio = $array['ratio'];
                if (isset($array['near']))
                    $this->_near = $array['near'];
                if (isset($array['far']))
                    $this->_far = $array['far'];
                $this->checker();
                $this->countMatrix();
                if (self::$verbose) {
                    if ($this->_preset == self::IDENTITY)
                        printf("Matrix " . $this->_preset . " instance constructed\n");
                    else if ($this->_preset)
                        printf("Matrix " . $this->_preset . " preset instance constructed\n");
                }
                $this->navigate();
            }
        }

        public function __destruct() {
            if (self::$verbose)
                printf("Matrix instance destructed\n");
        }

        public function __toString() {
            $temp = "M | vtcX | vtcY | vtcZ | vtx0\n";
            $temp .= "-----------------------------\n";
            $temp .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $temp .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $temp .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $temp .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
            return (vsprintf($temp, array($this->_matrix[0], $this->_matrix[1], $this->_matrix[2], $this->_matrix[3],
                $this->_matrix[4], $this->_matrix[5], $this->_matrix[6], $this->_matrix[7], $this->_matrix[8],
                $this->_matrix[9], $this->_matrix[10], $this->_matrix[11], $this->_matrix[12], $this->_matrix[13],
                $this->_matrix[14], $this->_matrix[15])));
        }

        public static function doc() {
            if ($content = file_get_contents("Matrix.doc.txt"))
                return($content);
            else
                return("Content not found: Matrix.doc.txt not read\n");
        }

        private function navigate() {
            switch ($this->_preset) {
                case (self::IDENTITY) :
                    $this->identity(1);
                    break;
                case (self::TRANSLATION) :
                    $this->translation();
                    break;
                case (self::SCALE) :
                    $this->identity($this->_scale);
                    break;
                case (self::RX) :
                    $this->rotation_X();
                    break;
                case (self::RY) :
                    $this->rotation_Y();
                    break;
                case (self::RZ) :
                    $this->rotation_Z();
                    break;
                case (self::PROJECTION) :
                    $this->projection();
                    break;
            }
        }

        private function countMatrix() {
            for ($i = 0; $i < 16; $i++)
                $this->_matrix[$i] = 0;
        }

        private function identity($scale) {
            $this->_matrix[0] = $scale;
            $this->_matrix[5] = $scale;
            $this->_matrix[10] = $scale;
            $this->_matrix[15] = 1;
        }

        private function translation() {
            $this->identity(1);
            $this->_matrix[3] = $this->_vtc->getX();
            $this->_matrix[7] = $this->_vtc->getY();
            $this->_matrix[11] = $this->_vtc->getZ();
        }

        private function rotation_X() {
            $this->identity(1);
            $this->_matrix[0] = 1;
            $this->_matrix[5] = cos($this->_angle);
            $this->_matrix[6] = -sin($this->_angle);
            $this->_matrix[9] = sin($this->_angle);
            $this->_matrix[10] = cos($this->_angle);
        }

        private function rotation_Y() {
            $this->identity(1);
            $this->_matrix[0] = cos($this->_angle);
            $this->_matrix[5] = sin($this->_angle);
            $this->_matrix[6] = 1;
            $this->_matrix[9] = -sin($this->_angle);
            $this->_matrix[10] = cos($this->_angle);
        }

        private function rotation_Z() {
            $this->identity(1);
            $this->_matrix[0] = cos($this->_angle);
            $this->_matrix[5] = -sin($this->_angle);
            $this->_matrix[6] = sin($this->_angle);
            $this->_matrix[9] = cos($this->_angle);
            $this->_matrix[10] = 1;
        }

        private function projection() {
            $this->identity(1);
            $this->_matrix[5] = 1 / tan(0.5 * deg2rad($this->_fov));
            $this->_matrix[0] = $this->_matrix[5] / $this->_ratio;
            $this->_matrix[10] = (-1) * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
            $this->_matrix[14] = (-1);
            $this->_matrix[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
            $this->_matrix[15] = 0;
        }

        private function checker() {
            if (empty($this->_preset) || ($this->_preset == self::SCALE && empty($this->_scale)) ||
                (($this->_preset == self::RX || $this->_preset == self::RY || $this->_preset == self::RZ) && empty($this->_angle))
                || ($this->_preset == self::TRANSLATION && empty($this->_vtc)) ||
                ((empty($this->_ratio) || empty($this->_fov) || empty($this->_near) || empty($this->_far)) && $this->_preset == self::PROJECTION))
                    return "error";
        }

        public function mult(Matrix $rhs) {
            $temp = array();
            for ($i = 0; $i < 16; $i += 4) {
                for ($j = 0; $j < 4; $j++) {
                    $temp[$i + $j] = 0;
                    $temp[$i + $j] += $this->_matrix[$i + 0] * $rhs->_matrix[$j + 0];
                    $temp[$i + $j] += $this->_matrix[$i + 1] * $rhs->_matrix[$j + 4];
                    $temp[$i + $j] += $this->_matrix[$i + 2] * $rhs->_matrix[$j + 8];
                    $temp[$i + $j] += $this->_matrix[$i + 3] * $rhs->_matrix[$j + 12];
                }
            }
            $matr = new Matrix($this->_matrix);
            $matr->_matrix = $temp;
            return $matr;
        }

        public function transformVertex(Vertex $vtx) {
            $temp = array();
            $temp['x'] = ($vtx->getX() * $this->_matrix[0]) + ($vtx->getY() * $this->_matrix[1]) +
                ($vtx->getZ() * $this->_matrix[2]) + ($vtx->getW() * $this->_matrix[3]);
            $temp['y'] = ($vtx->getX() * $this->_matrix[4]) + ($vtx->getY() * $this->_matrix[5]) +
                ($vtx->getZ() * $this->_matrix[6]) + ($vtx->getW() * $this->_matrix[7]);
            $temp['z'] = ($vtx->getX() * $this->_matrix[8]) + ($vtx->getY() * $this->_matrix[9]) +
                ($vtx->getZ() * $this->_matrix[10]) + ($vtx->getW() * $this->_matrix[11]);
            $temp['w'] = ($vtx->getX() * $this->_matrix[12]) + ($vtx->getY() * $this->_matrix[13]) +
                ($vtx->getZ() * $this->_matrix[14]) + ($vtx->getW() * $this->_matrix[15]);
            $vertex = new Vertex($temp);
            return $vertex;
        }
    }
?>