<?php

namespace Rover\Command;

use Rover\Command;
use Rover\MarsCommandFactory;
use Rover;

class Move implements Command
{
    public function run(Rover $rover)
    {
        switch($rover->getDirection()) {
            case MarsCommandFactory::NORTH:
                $rover->setY($rover->getY() + 1);
                break;
            case MarsCommandFactory::SOUTH:
                $rover->setY($rover->getY() - 1);
                break;
            case MarsCommandFactory::EAST:
                $rover->setX($rover->getX() + 1);
                break;
            case MarsCommandFactory::WEST:
                $rover->setX($rover->getX() - 1);
                break;
        }
        if ($this->isRoverOutOfPlateau($rover)) {
            throw new ExplorationError(
                "Rover was out of plateau [{$rover->getX()}, {$rover->getY()}]",
                MarsCommandFactory::ERR_OUT_OF_PLATEAU,
                $rover->getExplorationProgram()[$rover->getCurrentCommandNum()],
                $rover->getCurrentCommandNum()
            );
        }
    }

    private function isRoverOutOfPlateau(Rover $rover)
    {
        return $rover->getX() < 0 || $rover->getY() < 0 || $rover->getX() > $rover->getPlateau()->getTopX() || $rover->getY() > $rover->getPlateau()->getTopY();
    }
}