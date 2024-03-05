<?php

namespace App\Parser;

use App\Config\ParserConfig;

interface Parser
{
    public function parse(ParserConfig $config): array;
}
