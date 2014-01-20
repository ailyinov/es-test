<?php

use Rover\MarsCommandFactory;

include_once 'InputReader.php';
include_once 'Input/File.php';
include_once 'Input/InputPlateau.php';
include_once 'Input/InputRover.php';

include_once 'Plateau.php';
include_once 'Rover/Command.php';
include_once 'Rover/CommandFactory.php';
include_once 'Rover/CommandFactory/MarsCommandFactory.php';
include_once 'Rover/ExplorationError.php';
include_once 'Rover/Command/Move.php';
include_once 'Rover/Command/TurnLeft.php';
include_once 'Rover/Command/TurnRight.php';
include_once 'RoverSimple.php';
include_once 'Rover.php';

class App
{
    public function run()
    {
        $fileInput = new File(dirname(__FILE__) . '/data.txt');
        $plateauInput = $fileInput->getPlateau();
        $plateau = new Plateau($plateauInput->getX(), $plateauInput->getY());
        $marsCommandFactory = new MarsCommandFactory();
        foreach ($fileInput->getRovers() as $roverInput) {
            $rover = new Rover($roverInput->getX(), $roverInput->getY(), $roverInput->getDirection(), $plateau, $marsCommandFactory);
            $rover->setExploreProgram($roverInput->getExplorationProgram());
            $rover->runExploration();

            echo $rover->getX() . " ";
            echo $rover->getY() . " ";
            echo $rover->getDirection() . "\n";
            echo print_r($rover->getExplorationErrors(), true);
        }

    }
}

$app = new App();
$app->run();