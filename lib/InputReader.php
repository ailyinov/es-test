<?php

interface InputReader
{
    /**
     * @return InputPlateau
     */
    public function getPlateau();

    /**
     * @return InputRover[]
     */
    public function getRovers();
}