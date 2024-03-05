<?php

namespace App\Handler;

use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class BoolHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => XmlEncoder::FORMAT,
                'type' => 'yes_no_boolean',
                'method' => 'deserializeToBool',
            ],
        ];
    }

    public function deserializeToBool($boolAsString,): ?bool 
    {
        if ($boolAsString == null) {
            return null;
        }

        return $boolAsString == 'Yes' ? true : false;
    }
}
