<?php

class RoverSimple
{
    const NORTH = 'N';
    const SOUTH = 'S';
    const WEST = 'W';
    const EAST = 'E';

    const TURN_LEFT = 'L';
    const TURN_RIGHT = 'R';
    const MOVE = 'M';

    const ERR_OUT_OF_PLATEAU = 1;

    /**
     * @const
     */
    private static $LEFT_TURN = [
        self::NORTH => self::WEST,
        self::SOUTH => self::EAST,
        self::WEST => self::SOUTH,
        self::EAST => self::NORTH,
    ];

    /**
     * @const
     */
    private static $RIGHT_TURN = [
        self::NORTH => self::EAST,
        self::SOUTH => self::WEST,
        self::WEST => self::NORTH,
        self::EAST => self::SOUTH,
    ];

    private $x;
    private $y;
    private $direction;

    private $maxX;
    private $maxY;

    private $exploreProgram = [];
    private $explorationErrors = [];

    function __construct($x, $y, $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
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

    public function getExplorationErrors()
    {
        return $this->explorationErrors;
    }

    public function addExplorationError(array $error)
    {
        array_push($this->explorationErrors, $error);
    }

    public function setDirection($direction)
    {
        if (!in_array($direction, [self::NORTH, self::SOUTH, self::WEST, self::EAST])) {
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
            if (!in_array($command, [self::TURN_LEFT, self::TURN_RIGHT, self::MOVE])) {
                throw new DomainException('Unknown rover command');
            }
        }
        $this->exploreProgram = $exploreProgram;
    }

    public function getExploreProgram()
    {
        return $this->exploreProgram;
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

    public function runExploration()
    {
        $this->explorationErrors = [];
        foreach ($this->getExploreProgram() as $commandNum => $command) {
            switch($command) {
                case self::TURN_LEFT:
                    $this->turnLeft();
                    break;
                case self::TURN_RIGHT:
                    $this->turnRight();
                    break;
                case self::MOVE:
                    if (!$this->move()) {
                        $this->addExplorationError([
                            'code' => self::ERR_OUT_OF_PLATEAU,
                            'command_num' => $commandNum,
                            'command_code' => $command,
                            'message' => "Rover was out of plateau [{$this->getX()}, {$this->getY()}]"
                        ]);
                    }
                    break;
            }
        }
    }

    private function turnLeft()
    {
        $this->direction = self::$LEFT_TURN[$this->getDirection()];
    }

    private function turnRight()
    {
        $this->direction = self::$RIGHT_TURN[$this->getDirection()];
    }

    private function move()
    {
        switch($this->getDirection()) {
            case self::NORTH:
                $this->y++;
                break;
            case self::SOUTH:
                $this->y--;
                break;
            case self::EAST:
                $this->x++;
                break;
            case self::WEST:
                $this->x--;
                break;
        }
        return !$this->isOutOfPlateau();
    }

    public function isOutOfPlateau()
    {
        return $this->x < 0 || $this->y < 0 || $this->x > $this->getMaxX() || $this->y > $this->getMaxY() ;
    }
}