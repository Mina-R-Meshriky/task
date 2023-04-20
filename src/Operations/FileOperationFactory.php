<?php

namespace Mina\DevelopersTest\Operations;

use Exception;
use Mina\DevelopersTest\File;
use Mina\DevelopersTest\Operations\Types\Division;
use Mina\DevelopersTest\Operations\Types\Multiplication;
use Mina\DevelopersTest\Operations\Types\Summation;
use \Mina\DevelopersTest\Operations\Types\Difference;

class FileOperationFactory
{
    /**
     * a factory method for the various operations in the system
     *
     * @throws Exception
     */
    public static function make(
        string $action,
        string $filename,
        string $logFilename = "./log.txt",
        string $resultFilename = "./result.csv"
    ): OperationInterface {

        $readFile = new File($filename);
        $logFile = new File($logFilename, "w+");
        $resultFile = new File($resultFilename, "w+");

        return match ($action) {
            'plus' => new Summation($readFile, $logFile, $resultFile),
            'minus' => new Difference($readFile, $logFile, $resultFile),
            'multiply' => new Multiplication($readFile, $logFile, $resultFile),
            'division' => new Division($readFile, $logFile, $resultFile),
            default => throw new Exception("Unsupported action")
        };
    }
}