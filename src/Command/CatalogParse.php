<?php

namespace App\Command;

use App\Service\CatalogService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command;
use App\Factory\ParserConfigFactory;
use App\Parser\XmlParser;
use App\Saver\DatabaseSaver;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;
use Symfony\Component\Console\Input\InputOption;

class CatalogParse extends Command
{
    public const FILE_NAME_OPT = 'filename';
    public const PARSER_ARG = 'parser';
    public const SAVER_ARG = 'saver';

    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected LoggerInterface $logger,
        protected CatalogService $catalogService,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {   
        $this->setName('catalog:parse')
            ->setDescription('Parse catalog file.')
            ->addArgument(
                self::PARSER_ARG,
                InputArgument::REQUIRED,
                'Provide parser type.',
            )
            ->addArgument(
                self::SAVER_ARG,
                InputArgument::REQUIRED,
                'Provide saver type.',
            )
            ->addOption(
                self::FILE_NAME_OPT,
                null,
                InputOption::VALUE_REQUIRED,
                'Provide absolute path the file.',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Catalog parse',
            '============',
        ]);

        if ($input->getArgument(self::PARSER_ARG) == 'xml') {
            $parser = new XmlParser($this->logger);
            $config = ParserConfigFactory::createXmlConfig($input->getOption(self::FILE_NAME_OPT));

            $output->writeln('--filename: ' . $input->getOption(self::FILE_NAME_OPT));
        }

        if ($input->getArgument(self::SAVER_ARG) == 'db') {
            $saver = new DatabaseSaver($this->entityManager, $this->logger);
        }

        if (!isset($parser) || !isset($saver) || !isset($config)) {
            throw new RuntimeException('Unsupported configuration. Check parameters "parser" and "saver" values.');
        }

        $this->catalogService->setParser($parser);
        $this->catalogService->setSaver($saver);
        $this->catalogService->parseFile($config);
        
        return 0;
    }
}
