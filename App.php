<?php
include_once 'lib/InputReader.php';
include_once 'lib/InputPlateau.php';
include_once 'lib/InputRover.php';
include_once 'lib/InputReader/File.php';

include_once 'lib/Plateau.php';
include_once 'lib/Rover/Command.php';
include_once 'lib/Rover/CommandFactory.php';
include_once 'lib/Rover/CommandFactory/MarsCommandFactory.php';
include_once 'lib/Rover/ExplorationError.php';
include_once 'lib/Rover/Command/Move.php';
include_once 'lib/Rover/Command/TurnLeft.php';
include_once 'lib/Rover/Command/TurnRight.php';
include_once 'lib/Rover.php';

use InputReader\File;
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
            $rover->setExplorationProgram($inputRover->getExplorationProgram());
            $rover->runExploration();

            echo $rover->getX() . " ";
            echo $rover->getY() . " ";
            echo $rover->getDirection() . "\n";
            foreach($rover->getExplorationErrors() as $explorationError) {
                echo $explorationError->getMessage() . " comm. #{$explorationError->getCommandNum()}" . "\n";
            }
            echo str_repeat('=', 20) . "\n";
        }

    }
}

$app = new App();
$app->run();