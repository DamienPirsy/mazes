<?php

abstract class Maze {

	protected $width;
	protected $height;
    protected $isDebug;

    /**
    *  @param int $width
    *  @param int $height
    *  @param bool $debug
    */
	public function __construct($width, $height, $debug = false)
	{
		$this->width = $width;
		$this->height = $height;
        $this->isDebug = $debug; // debug flag
	}

	/**
	*  Generates the maze
	*  @return $this
	*/
	abstract public function generate();

    /**
    * Logs to stdOut if debug flag is enabled
    */
    protected function log(...$params)
    {
        if ($this->isDebug) {
            echo vsprintf(array_shift($params), $params).PHP_EOL;
        }
    }
}