<?php

namespace Mina\DevelopersTest\Operations\Types;

use Mina\DevelopersTest\Operations\FileOperation;

class Difference extends FileOperation
{

    public function operationName(): string
    {
        return 'minus';
    }

    public function calculateResult(int $a, int $b): float|int|null
    {
        return $a - $b;
    }

}