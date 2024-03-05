<?php

namespace App\Config;

class ParserConfig
{
    private array $arguments = [];

    public function getArgument(string $key): string 
    {
        return $this->arguments[$key];
    }

    public function setArgument(string $key, string $value): void
    {
        $this->arguments[$key] = $value;
    }
}
