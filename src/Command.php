<?php

namespace Mina\DevelopersTest;

class Command
{
    private string $short;
    private array $long;

    public function __construct()
    {
        $this->short = "a:f:";
        $this->long = [
            "action:",
            "file:",
        ];
    }

    /**
     * gets the command inputs
     * @return array<string>
     */
    public function getInputs(): array
    {
        $options = getopt($this->short, $this->long);

        return [$this->getAction($options), $this->getFilename($options)];
    }

    /**
     * gets the action string or sets a default action value
     * @param  array  $options
     * @return string
     */
    private function getAction(array $options): string
    {
        return $options['a'] ?? $options['action'] ?? "xyz";
    }

    /**
     * gets the filename string or sets a default filename value
     * @param  array  $options
     * @return mixed|string
     */
    private function getFilename(array $options): mixed
    {
        return $options['f'] ?? $options['file'] ?? "notexists.csv";
    }

}