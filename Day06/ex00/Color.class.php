<?php
    class Color {
        public $red;
        public $green;
        public $blue;
        static $verbose = False;

        public function __construct(array $color) {
            if (isset($color['red']) && isset($color['green']) && isset($color['blue'])) {
                $this->red = intval($color['red'], 10);
                $this->green = intval($color['green'], 10);
                $this->blue = intval($color['blue'], 10);
            }
            else if (isset($color['rgb'])) {
                $this->red = ($color['rgb'] >> 16) & 255;
                $this->green = ($color['rgb'] >> 8) & 255;
                $this->blue = ($color['rgb']) & 255;
            }
            if (self::$verbose)
                printf($this . " constructed.\n");
        }

        public function __destruct()
        {
            if (self::$verbose)
                printf($this. " destructed.\n");
        }

        public function __toString() {
            return (vsprintf("Color( red: %3d, green: %3d, blue %3d ) ", array($this->red, $this->green, $this->blue)));
        }

        public static function doc() {
            if ($content = file_get_contents("Color.doc.txt"))
                return($content);
            else
                return("Content not found: Color.doc.txt not read\n");
        }

        public function add($color) {
            return (new Color(array('red' => $this->red + $color->red, 'green' => $this->green + $color->green,
                'blue' => $this->blue + $color->blue)));
        }

        public function sub($color) {
            return (new Color(array('red' => $this->red - $color->red, 'green' => $this->green - $color->green,
                'blue' => $this->blue - $color->blue)));
        }

        public function mult($multer) {
            return (new Color(array('red' => $this->red * $multer, 'green' => $this->green * $multer,
                'blue' => $this->blue * $multer)));
        }

    }
?>