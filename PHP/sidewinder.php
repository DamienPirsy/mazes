<?php

require_once('./maze.php');

class Sidewinder extends Maze
{
	/**
	*  Contains the maze
	*/
	private $grid;
	private $weight = 1;
	protected $name = 'Sidewinder';	

	public function __construct($width, $height, $debug = false)
	{
		parent::__construct($width, $height, $debug);
		$this->grid = [];
	}

	/**
	*  Sets a custom weight to set the probability of a Norther opening
	*  @param int $weight
	*/
	public function setWeight($weight=1)
	{
		$this->weight = intval($weight);
	}

	/**
	*  Main method
	*/
	public function generate()
	{
		for ($y = 0; $y < $this->height; $y++) {
			$runSet = [];
			for ($x = 0; $x < $this->width; $x++) {
				$this->log('Adding current cell to runSet', $x);
				array_push($runSet, $x);
				if ($y === 0) {
					// first row, can only go east
					$this->log('First row, can only go east. No need to keep track of the current set');
					$this->grid[$y][$x] = ($x == $this->width-1) ? 'X|' : 'E';
				}  else {
					if ($x === $this->width-1 || (mt_rand(0, $this->weight) === 0)) {
						$this->grid[$y][$x] = 'X|';
						$this->log("Stop - Current set: %s", json_encode($runSet));
						$selected = $runSet[array_rand($runSet)];
						$this->log('Removing N wall from element at $x %d', $selected);
						$this->grid[$y][$selected] = $x == $selected ?  'N|' : 'N';
						$runSet = [];
					} else {
						$this->log('Current set: %s', json_encode($runSet));
						$this->grid[$y][$x] = 'E';
					}
				}
			}
		}
		return $this;
	}

	/**
	*  Prints to console
	*/
	public function printOut()
	{
		$northDoor = mt_rand(0, $this->width-1);
		$southDoor = mt_rand(0, $this->width-1);

        $str = '';
        for ($i=0; $i<$this->height; $i++) {
            
            $str .= "\n+";
            for ($j=0; $j<$this->width; $j++) {
            	$str .= ($this->grid[$i][$j] == 'N' || $this->grid[$i][$j] == 'N|' || ($i===0 && $j==$northDoor)) ? '   +' : '---+';
            }
            $str .=  "\n|";
            for ($j=0; $j<$this->width; $j++) {
                $str .= ($this->grid[$i][$j] == 'E' || $this->grid[$i][$j] == 'N') ? '    ' : '   |';
            }
        }
        $str .= "\n+";
        for ($i=0;$i<$this->width;$i++) {
            $str .= $i == $southDoor ? '   +' : '---+';
        }        
		echo "\n$str\n";
	}
}



$maze = new Sidewinder(12, 8);
//$maze->setWeight(10);
$maze->generate()->printOut();