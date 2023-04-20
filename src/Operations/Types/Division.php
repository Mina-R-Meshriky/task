<?php

// here we will make division
namespace Mina\DevelopersTest\Operations\Types;

use Mina\DevelopersTest\Operations\FileOperation;

class Division extends FileOperation
{
    public function operationName(): string
    {
        return 'division';
    }

    public function calculateResult(int $a, int $b): float|int|null
    {
        if ($b === 0) {
            return null;
        }

        return floatval($a / $b);
    }


}