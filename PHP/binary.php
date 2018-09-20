<?php

require_once('./maze.php');


class Binary extends Maze
{
	private $grid;

	/**
	*  @inheritDocs
	*/
	public function __construct($width, $height, $debug = false)
	{
		parent::__construct($width, $height, $debug);
		$this->grid = [];
        $this->directions = [[0, -1], [1, 0]]; // S, E
	}

	/**
	*  @inheritDocs
	*/
	public function generate()
	{
		$this->initMaze();
        for ($y=0; $y<$this->height; $y++) {
            for ($x=0; $x < $this->width; $x++) {
                if ($x == $this->width-1 && $y == $this->height-1) {
                    $this->grid[$y][$x] = 'X ';
                    return $this;
                }
                if ($x == $this->width-1) {
                    $this->grid[$y][$x] = 'S';
                } elseif ($y == $this->height-1) {
                    $this->grid[$y][$x] = 'E';
                } else {
                    // pick random
                    $p = $this->directions[rand(0,1)][0] == 0 ? 'S' : 'E';
                    $this->grid[$y][$x] = $p;
                }
            }
        }
		return $this;
	}

	/**
	*
	*/
    public function printOut()
    {
              
        $northDoor = mt_rand(0,$this->width-1);
        $westDoor = mt_rand(0, $this->height-1);

        $str = '+';
        for ($i=0;$i<$this->width;$i++) {
            $str .= ($northDoor == $i) ? '   +' : '---+';
        }

        $str .= PHP_EOL;
        for ($i=0; $i<$this->height; $i++) {
            
            $str .= $i == $westDoor ? ' ' : '|';
            for ($j=0; $j<$this->width; $j++) {
                $str .= $this->grid[$i][$j] == 'E' ? '    ' : '   |';
            }
            $str .= PHP_EOL."+";
            for ($j=0; $j<$this->width; $j++) {
                $str .= $this->grid[$i][$j] == 'S' ? '   +' : '---+';
            }
            $str .= PHP_EOL;
        }
        echo $str;
    }

	/**
    * Initialzie an empty grid of $width * $height dimensions
    */
    private function initMaze()
    {
        for ($i=0;$i<$this->width;$i++) {
            for ($j = 0;$j<$this->height;$j++) {
                $this->grid[$i][$j] = null;
            }
        }
    }

}

$maze = new Binary(6, 6);
$maze->generate()->printOut();