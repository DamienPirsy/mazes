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
        $this->directions = [];
        // map of coordinates of N,S,W,E
        $this->dirs = [ 'N' => [0, 1], 'S' => [0, -1], 'W' => [-1, 0], 'E' => [1, 0]];
        $this->setDirs('S', 'E');
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
            //$str .= '---+';
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
	*  Sets initial maze directions
	*  The method is public to allow customization and experimentation of bias
 	*  @param string $dir1 (N, S, W, E)
 	*  @param string $dir2 (N, S, W, E)
 	*  @return null
	*/
	public function setDirs($dir1 = 'S', $dir2 = 'E')
	{
		$allowed = ['N', 'S', 'W', 'E'];
		$dir1 = strtoupper($dir1);
		$dir2 = strtoupper($dir2);
		if (!in_array($dir1, $allowed) && !in_array($dir2, $allowed)) {
			$this->setDirs('S', 'E');
		} else {
			array_push ($this->directions, $this->dirs[$dir1]);
			array_push ($this->directions, $this->dirs[$dir2]);
		}
	}


	/**
    * Initialzie an empty grid of $width * $height dimensions
    */
    private function initMaze()
    {
        for ($i=0;$i<$this->width;$i++) {
            for ($j = 0;$j<$this->height;$j++) {
                $this->grid[$i][$j] = false;
            }
        }
    }

}

$maze = new Binary(6, 6, true);
$maze->generate()->printOut();