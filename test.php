<?php
use Rover\MarsCommandFactory;

include_once 'Rover/Command.php';
include_once 'Rover/CommandFactory.php';
include_once 'Rover/CommandFactory/MarsCommandFactory.php';
include_once 'Rover/ExplorationError.php';
include_once 'Rover/Command/Move.php';
include_once 'Rover/Command/TurnLeft.php';
include_once 'Rover/Command/TurnRight.php';
include_once 'RoverSimple.php';
include_once 'Rover.php';

$rover = new RoverSimple(1, 2, 'N');
$rover->setExploreProgram('LMLMLMLMM');
$rover->setMaxX(5);
$rover->setMaxY(5);

$rover2 = new RoverSimple(3, 3, 'E');
$rover2->setExploreProgram('MMRMMRMRRM');
$rover2->setMaxX(5);
$rover2->setMaxY(5);

$rover->runExploration();
echo $rover->getX() . " ";
echo $rover->getY() . " ";
echo $rover->getDirection() . "\n";
echo print_r($rover->getExplorationErrors(), true);

$rover2->runExploration();
echo $rover2->getX() . " ";
echo $rover2->getY() . " ";
echo $rover2->getDirection() . "\n";
echo print_r($rover2->getExplorationErrors(), true);

echo '====================' . "\n";
$marsCF = new MarsCommandFactory();
$rover3 = new Rover(1, 2, 'N', $marsCF);
$rover3->setExploreProgram('LMLMLMLMM');
$rover3->setMaxX(5);
$rover3->setMaxY(5);

$rover4 = new Rover(3, 3, 'E', $marsCF);
$rover4->setExploreProgram('MMRMMRMRRMM');
$rover4->setMaxX(5);
$rover4->setMaxY(5);

$rover3->runExploration();
echo $rover3->getX() . " ";
echo $rover3->getY() . " ";
echo $rover3->getDirection() . "\n";
echo print_r($rover3->getExplorationErrors(), true);

$rover4->runExploration();
echo $rover4->getX() . " ";
echo $rover4->getY() . " ";
echo $rover4->getDirection() . "\n";
echo print_r($rover4->getExplorationErrors(), true);

