<?php

namespace Rover\Command;


use Rover\Command;
use Rover\MarsCommandFactory;
use Rover;

class TurnLeft implements Command
{
    public function run(Rover $rover)
    {
        switch($rover->getDirection()) {
            case MarsCommandFactory::NORTH:
                $rover->setDirection(MarsCommandFactory::WEST);
                break;
            case MarsCommandFactory::SOUTH:
                $rover->setDirection(MarsCommandFactory::EAST);
                break;
            case MarsCommandFactory::WEST:
                $rover->setDirection(MarsCommandFactory::SOUTH);
                break;
            case MarsCommandFactory::EAST:
                $rover->setDirection(MarsCommandFactory::NORTH);
                break;
        }
    }
}