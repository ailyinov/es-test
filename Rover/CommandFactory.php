<?php

namespace Rover;


interface CommandFactory
{
    public function getCommandsList();

    public function getDirectionsList();

    /**
     * @param String $command
     * @return Command
     */
    public function getCommand($command);
}