<?php

namespace Tests\Unit\Command;

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Config\ParserConfig;
use App\Command\CatalogParse;
use App\Service\CatalogService;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use RuntimeException;

class CatalogParserTest extends TestCase
{
    private ?CommandTester $commandTester;
    private mixed $catalogServiceMock;

    protected function setUp(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $this->catalogServiceMock = $this->getMockBuilder(CatalogService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $application = new Application();
        $application->add(new CatalogParse($entityManager, $logger, $this->catalogServiceMock));
        $command = $application->find('catalog:parse');
        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown(): void
    {
        $this->commandTester = null;
        $this->catalogServiceMock = null;
    }

    public function testParserOk()
    {
        $filename = 'some_file_name.xml';

        $this->catalogServiceMock
            ->expects($this->once())
            ->method('parseFile')
            ->with($this->isInstanceOf(ParserConfig::class));

        $this->commandTester->execute(
            [
                CatalogParse::PARSER_ARG => 'xml',
                CatalogParse::SAVER_ARG => 'db',
                '--' . CatalogParse::FILE_NAME_OPT => $filename,
            ]
        );

        $this->assertStringContainsString($filename, $this->commandTester->getDisplay());
    }

    public function testParserWrongParser()
    {
        $filename = 'some_file_name.xml';

        $this->catalogServiceMock
            ->expects($this->never())
            ->method('parseFile');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unsupported configuration. Check parameters "parser" and "saver" values.');

        $this->commandTester->execute(
            [
                CatalogParse::PARSER_ARG => 'yaml',
                CatalogParse::SAVER_ARG => 'db',
                '--' . CatalogParse::FILE_NAME_OPT => $filename,
            ]
        );
    }
}
