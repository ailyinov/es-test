<?php

class File implements InputReader
{
    private $filePath;
    private $rovers;
    private $plateau;

    function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->rovers = [];

        if (!file_exists($filePath)) {
            throw new ErrorException("File $filePath does not exists.");
        }

        $handle = @fopen($filePath, "r");
        if (!$handle) {
            throw new ErrorException("Can't open $filePath for read.");
        }

        if (!$plateau = fgets($handle)) {
            throw new ErrorException("Can't read plateau coordinates. Check $filePath format.");
        }

        list($plateauX, $plateauY) = explode(' ', trim($plateau));
        $this->plateau = new InputPlateau($plateauX, $plateauY);

        while (($rover = fgets($handle)) !== false) {
            list($x, $y, $direction) = explode(' ', trim($rover));
            if (!$explorationProgram = trim(fgets($handle))) {
                throw new ErrorException("Can't get exploration program for Rover. Check $filePath format.");
            }
            $this->rovers[] = new InputRover($direction, $explorationProgram, $x, $y);
        }

        if (!feof($handle)) {
            throw new ErrorException("Error: unexpected fgets() fail");
        }

        fclose($handle);
    }

    public function getPlateau()
    {
        return $this->plateau;
    }

    public function getRovers()
    {
        return $this->rovers;
    }
}