<?php

namespace Mina\DevelopersTest;

use Exception;

class File
{
    private $file;
    private string $mode;

    /**
     * @throws Exception
     */
    public function __construct($filename, $mode = 'r')
    {
        $this->mode = $mode;

        if(!file_exists($filename)) {
            throw new Exception("could not find file: {$filename}");
        }

        $this->file = match ($mode) {
            'r' => fopen($filename, 'r'),
            'w+' => fopen($filename, 'w+'),
            'a+' => fopen($filename, 'a+'),
            default => throw new Exception('Mode must be either r, w+, a+')
        };

        if (!$this->file) {
            throw new Exception("$filename cannot be opened with the selected mode");
        }
    }

    public function handler()
    {
        return $this->file;
    }

    public function write(string $string): bool
    {
        if ($this->mode != 'r') {
            return (bool) fwrite($this->file, $string);
        }

        return false;
    }

    public function close(): bool
    {
        if ($this->file) {
            return fclose($this->file);
        }

        return false;
    }

}