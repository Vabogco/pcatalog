<?php

namespace Tests\Unit\Parser;

use App\Config\ParserConfig;
use App\Config\ParserArgument;
use App\Parser\Parser;
use App\Saver\Saver;
use App\Dto\ItemDto;
use App\Exception\ValidationException;
use App\Service\CatalogService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CatalogServiceTest extends KernelTestCase
{
    private $catalogService;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->catalogService = $container->get(CatalogService::class);
    }

    protected function tearDown(): void
    {
        $this->catalogService = null;
    }

    public function testParseFileSuccess()
    {
        $parserConfig = new ParserConfig();
        $parserConfig->setArgument(ParserArgument::FILENAME, "mocked_file.xml");

        $item = new ItemDto();
        $item->setCategoryName('Green Mountain Ground Coffee');
        $item->setEntityId(340);
        $item->setSku('20');
        $item->setLink('http://www.coffeeforless.com');
        $item->setImage('http://mcdn.coffeeforless.com/media.jpg');
        $item->setInstock(true);
        $item->setFacebook(true);
        $item->setIsKCup(false);

        $items = [$item];

        $parserMock = $this->createMock(Parser::class);
        $parserMock->expects($this->once())
            ->method('parse')
            ->with($parserConfig)
            ->willReturn($items);

        $saverMock = $this->createMock(Saver::class);
        $saverMock->expects($this->once())
            ->method('save')
            ->with($items);

        /** @var CatalogService */
        $this->catalogService->setParser($parserMock);
        $this->catalogService->setSaver($saverMock);
        $this->catalogService->parseFile($parserConfig);
    }

    public function testParseFileValidationError()
    {
        $parserConfig = new ParserConfig();
        $parserConfig->setArgument(ParserArgument::FILENAME, "mocked_file.xml");

        $item = new ItemDto();
        $items = [$item];

        $parserMock = $this->createMock(Parser::class);
        $parserMock->expects($this->once())
            ->method('parse')
            ->with($parserConfig)
            ->willReturn($items);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Validation error while uploading catalog.');

        /** @var CatalogService */
        $this->catalogService->setParser($parserMock);
        $this->catalogService->parseFile($parserConfig);
    }
}
