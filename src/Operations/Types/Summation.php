<?php

namespace Mina\DevelopersTest\Operations\Types;


use Mina\DevelopersTest\Operations\FileOperation;

class Summation extends FileOperation
{
    public function operationName(): string
    {
        return 'plus';
    }

    public function calculateResult(int $a, int $b): float|int|null
    {
        return $a + $b;
    }

}