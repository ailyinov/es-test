<?php

namespace Rover;


use DomainException;
use Rover\Command\Move;
use Rover\Command\TurnRight;
use Rover\Command\TurnLeft;

class MarsCommandFactory implements CommandFactory
{
    const ERR_OUT_OF_PLATEAU = 1;

    const TURN_LEFT = 'L';
    const TURN_RIGHT = 'R';
    const MOVE = 'M';

    const NORTH = 'N';
    const SOUTH = 'S';
    const WEST = 'W';
    const EAST = 'E';

    public function getCommandsList()
    {
        return [self::MOVE, self::TURN_LEFT, self::TURN_RIGHT];
    }

    public function getDirectionsList()
    {
        return [self::NORTH, self::SOUTH, self::WEST, self::EAST];
    }

    public function getCommand($command)
    {
        switch($command) {
            case self::TURN_LEFT:
                return new TurnLeft();
                break;
            case self::TURN_RIGHT:
                return new TurnRight();
                break;
            case self::MOVE:
                return new Move();
                break;
            default:
                throw new DomainException('Illegal rover command');
        }
    }
} 