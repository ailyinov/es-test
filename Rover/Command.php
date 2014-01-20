<?php
namespace Rover;

use Rover;

interface Command
{
    public function run(Rover $rover);
} 