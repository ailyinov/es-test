<?php

class InputRover
{
    private $x;
    private $y;
    private $direction;
    private $explorationProgram;

    function __construct($direction, $explorationProgram, $x, $y)
    {
        $this->direction = $direction;
        $this->explorationProgram = $explorationProgram;
        $this->x = $x;
        $this->y = $y;
    }


    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function setExplorationProgram($explorationProgram)
    {
        $this->explorationProgram = $explorationProgram;
    }

    public function getExplorationProgram()
    {
        return $this->explorationProgram;
    }

    public function setX($roverX)
    {
        $this->x = $roverX;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setY($roverY)
    {
        $this->y = $roverY;
    }

    public function getY()
    {
        return $this->y;
    }
}