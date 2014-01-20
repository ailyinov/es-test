<?php

namespace Rover\Command;

use Rover;
use Rover\Command;
use Rover\MarsCommandFactory;

class TurnRight implements Command
{
    public function run(Rover $rover)
    {
        switch($rover->getDirection()) {
            case MarsCommandFactory::NORTH:
                $rover->setDirection(MarsCommandFactory::EAST);
                break;
            case MarsCommandFactory::SOUTH:
                $rover->setDirection(MarsCommandFactory::WEST);
                break;
            case MarsCommandFactory::WEST:
                $rover->setDirection(MarsCommandFactory::NORTH);
                break;
            case MarsCommandFactory::EAST:
                $rover->setDirection(MarsCommandFactory::SOUTH);
                break;
        }
    }
}