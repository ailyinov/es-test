<?php

namespace Rover\Command;


use RuntimeException;

class ExplorationError extends RuntimeException
{
    private $commandNum;
    private $commandCode;

    function __construct($message, $code, $commandCode, $commandNum)
    {
        $this->commandCode = $commandCode;
        $this->commandNum = $commandNum;
        parent::__construct($message, $code);
    }
}