<?php

namespace Mina\DevelopersTest\Operations;

interface OperationInterface
{

    /**
     * the operation name
     * @return string
     */
    public function operationName(): string;

    /**
     * calculates the result of a and b according to the operation
     * @param  int  $a
     * @param  int  $b
     * @return float|int|null
     */
    public function calculateResult(int $a, int $b): float|int|null;

}