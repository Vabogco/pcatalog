<?php

namespace App\Parser;

use App\Config\ParserArgument;
use App\Config\ParserConfig;
use App\Dto\CatalogDto;
use App\Dto\ItemDto;
use App\Handler\BoolHandler;
use App\Exception\ParseException;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Handler\HandlerRegistry;
use Psr\Log\LoggerInterface;
use RuntimeException;
use JMS\Serializer\Exception\XmlErrorException;

class XmlParser implements Parser
{
    protected SerializerInterface $serializer;

    public function __construct(
        protected LoggerInterface $logger,
    ) {
        $builder = SerializerBuilder::create();
        $builder->configureHandlers(function(HandlerRegistry $registry) {
            $registry->registerSubscribingHandler(new BoolHandler());
        });
        $this->serializer = $builder->build();
    }

    /**
     * @throws Exception
     * @return ItemDto[]
    */
    public function parse(ParserConfig $config): array
    {
        $this->logger->info("XMLParser: starting to parse source.");

        try {
            $xmlPlainText = $this->readFile($config->getArgument(ParserArgument::FILENAME));
            $parsedCatalogDto = $this->serializer->deserialize($xmlPlainText, CatalogDto::class, 'xml');

            return $parsedCatalogDto->getItems();
        } catch(XmlErrorException $e) {
            $this->logger->error('xml-file is incorrect');

            throw new ParseException($e->getMessage());
        } catch (RuntimeException $e) {
            $exceptionContext = [
                'responseBody' => 'Read file error.',
                'exception'    => get_class($e),
                'message'      => $e->getMessage(),
            ];

            $this->logger->error(
                'invalid xml',
                $exceptionContext,
            );

            throw new ParseException($e->getMessage());
        }
    }

    public function readFile(string $filename): string
    {
        return file_get_contents($filename);
    }
}
