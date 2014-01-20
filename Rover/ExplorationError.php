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

    public function setCommandCode($commandCode)
    {
        $this->commandCode = $commandCode;
    }

    public function getCommandCode()
    {
        return $this->commandCode;
    }

    public function setCommandNum($commandNum)
    {
        $this->commandNum = $commandNum;
    }

    public function getCommandNum()
    {
        return $this->commandNum;
    }
}