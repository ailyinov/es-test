<?php

class Plateau
{
    private $topX;
    private $topY;

    function __construct($topX, $topY)
    {
        $this->topX = $topX;
        $this->topY = $topY;
    }

    public function setTopX($topX)
    {
        $this->topX = $topX;
    }

    public function getTopX()
    {
        return $this->topX;
    }

    public function setTopY($topY)
    {
        $this->topY = $topY;
    }

    public function getTopY()
    {
        return $this->topY;
    }


}