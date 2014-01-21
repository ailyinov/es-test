<?php
include_once 'InputReader.php';
include_once 'InputPlateau.php';
include_once 'InputRover.php';
include_once 'Input/File.php';

include_once 'Plateau.php';
include_once 'Rover/Command.php';
include_once 'Rover/CommandFactory.php';
include_once 'Rover/CommandFactory/MarsCommandFactory.php';
include_once 'Rover/ExplorationError.php';
include_once 'Rover/Command/Move.php';
include_once 'Rover/Command/TurnLeft.php';
include_once 'Rover/Command/TurnRight.php';
include_once 'Rover.php';

use Input\File;
use Rover\MarsCommandFactory;

class App
{
    public function run()
    {
        $fileInput = new File(dirname(__FILE__) . '/data.txt');
        $inputPlateau = $fileInput->getPlateau();
        $plateau = new Plateau($inputPlateau->getX(), $inputPlateau->getY());
        $marsCommandFactory = new MarsCommandFactory();
        foreach ($fileInput->getRovers() as $inputRover) {
            $rover = new Rover($inputRover->getX(), $inputRover->getY(), $inputRover->getDirection(), $plateau, $marsCommandFactory);
            $rover->setExploreProgram($inputRover->getExplorationProgram());
            $rover->runExploration();

            echo $rover->getX() . " ";
            echo $rover->getY() . " ";
            echo $rover->getDirection() . "\n";
            foreach($rover->getExplorationErrors() as $explorationError) {
                echo $explorationError->getMessage() . "\n";
            }
            echo str_repeat('=', 20) . "\n";
        }

    }
}

$app = new App();
$app->run();