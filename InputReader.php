<?php

interface InputReader
{
    /**
     * @return InputPlateau
     */
    public function getPlateau();

    /**
     * @return array InputRovers
     */
    public function getRovers();
}