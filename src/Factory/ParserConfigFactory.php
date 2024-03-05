<?php

namespace App\Factory;

use App\Config\ParserConfig;
use App\Config\ParserArgument;

class ParserConfigFactory
{
    public static function createXmlConfig(string $filename): ParserConfig
    {
        $config = new ParserConfig();
        $config->setArgument(ParserArgument::FILENAME, $filename);

        return $config;
    }
}
