<?php

namespace Mina\DevelopersTest\Operations;

abstract class FileOperation implements OperationInterface
{
    public function __construct(protected $readFile, protected $logFile, protected $resultFile) { }

    /**
     * executes the file operation
     * @return void
     */
    public function execute(): void
    {
        $this->logStartOfOperation();

        foreach ($this->readFileContents() as [$a, $b]) {

            $result = $this->calculateResult($a, $b);

            if ($this->isValid($result)) {
                $this->appendToResults($a, $b, $result);
            } else {
                $this->logErrors($a, $b);
            }
        }

        $this->logFinishOfOperation();
    }

    /**
     * Reads the file contents
     * @return \Generator
     */
    protected function readFileContents(): \Generator
    {
        while (($line = fgets($this->readFile->handler())) !== false) {

            $line = explode(";", $line);

            if (count($line) != 2) {
                $this->logErrors(...$line);
                continue;
            }

            yield $this->extractNumbers($line);
        }
    }

    /**
     * @param  array  $line
     * @return array<int>
     */
    protected function extractNumbers(array $line): array
    {
        $a = intval(trim($line[0]));
        $b = intval(trim($line[1]));
        return [$a, $b];
    }

    /**
     * @param  int|float|null  $result
     * @return bool
     */
    protected function isValid(int|float|null $result): bool
    {
        if (is_null($result) || $result < 0) {
            return false;
        }

        return true;
    }

    /**
     * @param  mixed  ...$numbers
     * @return void
     */
    protected function logErrors(...$numbers): void
    {
        $numString = join(' and ', $numbers);
        $this->logFile->write("numbers {$numString} are wrong\r\n");
    }

    /**
     * @param  int  $a
     * @param  int  $b
     * @param  int|float  $result
     * @return void
     */
    protected function appendToResults(int $a, int $b, int|float $result): void
    {
        $this->resultFile->write("{$a};{$b};{$result}\r\n");
    }


    protected function logStartOfOperation(): void
    {
        $this->logFile->write("Started {$this->operationName()} operation\r\n");
    }

    protected function logFinishOfOperation(): void
    {
        $this->logFile->write("Finished {$this->operationName()} operation\r\n");
    }

    public function __destruct()
    {
        $this->readFile->close();
        $this->logFile->close();
        $this->resultFile->close();
    }
}