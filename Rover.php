<?php

use Rover\Command\ExplorationError;
use Rover\CommandFactory;

class Rover
{
    private $x;
    private $y;
    private $direction;

    private $maxX;
    private $maxY;

    private $exploreProgram = [];
    private $explorationErrors = [];
    private $currentCommandNum;

    private $commandFactory;

    function __construct($x, $y, $direction, CommandFactory $commandFactory)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
        $this->commandFactory = $commandFactory;
    }

    public function setDirection($direction)
    {
        if (!in_array($direction, $this->commandFactory->getDirectionsList())) {
            throw new DomainException('Illegal rover direction');
        }
        $this->direction = $direction;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function setExploreProgram($exploreProgram)
    {
        if (!is_string($exploreProgram)) {
            throw new InvalidArgumentException('Illegal rover command format');
        }

        $exploreProgram = str_split($exploreProgram);

        foreach ($exploreProgram as &$command) {
            $command = strtoupper($command);
            if (!in_array($command, $this->commandFactory->getCommandsList())) {
                throw new DomainException('Unknown rover command');
            }
        }
        $this->exploreProgram = $exploreProgram;
    }

    public function getExploreProgram()
    {
        return $this->exploreProgram;
    }

    public function runExploration()
    {
        $this->explorationErrors = [];
        foreach ($this->getExploreProgram() as $cn => $command) {
            $this->setCurrentCommandNum($cn);
            try {
                $this->commandFactory->getCommand($command)->run($this);
            } catch (ExplorationError $ee) {
                $this->addExplorationError($ee);
            }
        }
    }

    public function getExplorationErrors()
    {
        return $this->explorationErrors;
    }

    protected function addExplorationError(ExplorationError $error)
    {
        array_push($this->explorationErrors, $error);
    }

    public function setCurrentCommandNum($currentCommandNum)
    {
        $this->currentCommandNum = $currentCommandNum;
    }

    public function getCurrentCommandNum()
    {
        return $this->currentCommandNum;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setY($y)
    {
        $this->y = $y;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setMaxX($maxX)
    {
        $this->maxX = $maxX;
    }

    public function getMaxX()
    {
        return $this->maxX;
    }

    public function setMaxY($maxY)
    {
        $this->maxY = $maxY;
    }

    public function getMaxY()
    {
        return $this->maxY;
    }

    public function setCommandFactory(CommandFactory $commandFactory)
    {
        $this->commandFactory = $commandFactory;
    }

    public function getCommandFactory()
    {
        return $this->commandFactory;
    }


}