<?php

namespace Mina\DevelopersTest\Operations\Types;

use Mina\DevelopersTest\Operations\FileOperation;

class Multiplication extends FileOperation
{
    public function operationName(): string
    {
        return 'multiply';
    }

    public function calculateResult($a, $b): float|int|null
    {
        return $a * $b;
    }

}