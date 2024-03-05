<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Parser\Parser;
use App\Saver\Saver;
use App\Config\ParserConfig;
use App\Exception\ValidationException;

class CatalogService
{
    private Parser $parser;
    private Saver $saver;

    public function __construct(
        private LoggerInterface $logger,
        private ValidatorInterface $validator,
    ) {}

    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function setSaver(Saver $saver)
    {
        $this->saver = $saver;
    }

    /**
     * @throws Exception
     */
    public function parseFile(ParserConfig $config): void
    {
        $itemArray = $this->parser->parse($config);

        $this->logger->info("CatalogService: Validation of unparsed DTOs.");
        $errors = $this->validator->validate($itemArray);

        if (count($errors) > 0) {
            $validationErrors = array_map(
                fn ($err) => $err->getPropertyPath() . ':' . $err->getMessage(),
                iterator_to_array($errors),
            );

            $this->logger->error(
                'CatalogService: Validation error while uploading catalog.',
                [
                    'errors' => $validationErrors,
                ]
            );

            throw new ValidationException("Validation error while uploading catalog.", $errors);;
        }

        $this->saver->save($itemArray);
    }
}
