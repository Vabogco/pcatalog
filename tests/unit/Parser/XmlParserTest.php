<?php

namespace Tests\Unit\Parser;

use PHPUnit\Framework\TestCase;
use App\Parser\XmlParser;
use App\Config\ParserConfig;
use App\Config\ParserArgument;
use Psr\Log\LoggerInterface;
use App\Exception\ParseException;

class XmlParserTest extends TestCase
{
    private $xmlDataCorrect = <<<EOF
    <?xml version="1.0" encoding="utf-8"?>
    <catalog>
        <item>
            <entity_id>340</entity_id>
            <CategoryName><![CDATA[Green Mountain Ground Coffee]]></CategoryName>
            <sku>20</sku>
            <name><![CDATA[Green Mountain Coffee French Roast Ground Coffee 24 2.2oz Bag]]></name>
            <description></description>
            <shortdesc><![CDATA[Green Mountain Coffee French Roast.]]></shortdesc>
            <price>41.6000</price>
            <link>http://www.coffeeforless.com/green-mountain-coffee.html</link>
            <image>http://mcdn.coffeeforless.com/media/catalog/product/images/uploads/intro/frac_box.jpg</image>
            <Brand><![CDATA[Green Mountain Coffee]]></Brand>
            <Rating>0</Rating>
            <CaffeineType>Caffeinated</CaffeineType>
            <Count>24</Count>
            <Flavored>No</Flavored>
            <Seasonal>No</Seasonal>
            <Instock>Yes</Instock>
            <Facebook>1</Facebook>
            <IsKCup>0</IsKCup>
        </item>
    </catalog>
    EOF;

    private $xmlDataWrong = <<<EOF
    <?xml version="1.0" encoding="utf-8"?>
    <catalog>
        <item>
            <entity_id>340</entity_id>
            <CategoryName><![CDATA[Green Mountain Ground Coffee]]></CategoryName>
            <sku>20
        </item>
    </catalog>
    EOF;

    public function testParse(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $parserConfig = new ParserConfig();
        $parserConfig->setArgument(ParserArgument::FILENAME, "mocked");
        $xmlParserMock = $this->getMockBuilder(XmlParser::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs([$logger])
            ->onlyMethods(['readFile'])
            ->getMock();
        
        $xmlParserMock->expects($this->once())
            ->method('readFile')
            ->willReturn(
                $this->xmlDataCorrect
            );

        $dtoArray = $xmlParserMock->parse($parserConfig);

        $this->assertEquals(340, reset($dtoArray)->getEntityId());
        $this->assertEquals('Green Mountain Ground Coffee', reset($dtoArray)->getCategoryName());
        $this->assertEquals('20', reset($dtoArray)->getSku());
        $this->assertEquals('', reset($dtoArray)->getDescription());
        $this->assertEquals('Green Mountain Coffee French Roast.', reset($dtoArray)->getShortdesc());
        $this->assertEquals('41.600', reset($dtoArray)->getPrice());
        $this->assertEquals('http://www.coffeeforless.com/green-mountain-coffee.html', reset($dtoArray)->getLink());
        $this->assertEquals('http://mcdn.coffeeforless.com/media/catalog/product/images/uploads/intro/frac_box.jpg', reset($dtoArray)->getImage());
        $this->assertEquals('Green Mountain Coffee', reset($dtoArray)->getBrand());
        $this->assertEquals(0, reset($dtoArray)->getRating());
        $this->assertEquals('Caffeinated', reset($dtoArray)->getCaffeineType());
        $this->assertEquals(24, reset($dtoArray)->getCount());
        $this->assertEquals(false, reset($dtoArray)->getFlavored());
        $this->assertEquals(false, reset($dtoArray)->getSeasonal());
        $this->assertEquals(false, reset($dtoArray)->getInstock());
        $this->assertEquals(true, reset($dtoArray)->getFacebook());
        $this->assertEquals(false, reset($dtoArray)->getIsKCup());
    }

    public function testParseFailed(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $parserConfig = new ParserConfig();
        $parserConfig->setArgument(ParserArgument::FILENAME, "mocked");
        $xmlParserMock = $this->getMockBuilder(XmlParser::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs([$logger])
            ->onlyMethods(['readFile'])
            ->getMock();
        
        $xmlParserMock->expects($this->once())
            ->method('readFile')
            ->willReturn(
                $this->xmlDataWrong
            );

        $this->expectException(ParseException::class);
   
        $xmlParserMock->parse($parserConfig);
    }
}
