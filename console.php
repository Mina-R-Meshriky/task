<?php

require 'vendor/autoload.php';

use Mina\DevelopersTest\Command;
use Mina\DevelopersTest\Operations\FileOperationFactory;

$command = new Command();
list($action, $file) = $command->getInputs();

$operation = FileOperationFactory::make($action, $file);
$operation->execute();