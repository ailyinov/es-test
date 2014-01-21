<?php

interface InputReader
{
    /**
     * @return InputPlateau
     */
    public function getPlateau();

    /**
     * @return array InputRover
     */
    public function getRovers();
}