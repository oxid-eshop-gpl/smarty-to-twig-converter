<?php

namespace sankar\ST\Tests\Unit;

use PHPUnit\Framework\TestCase;
use toTwig\Converter\InsertConverter;

class InsertConverterTest extends TestCase
{

    /** @var InsertConverter */
    protected $converter;

    public function setUp()
    {
        $this->converter = new InsertConverter();
    }

    /**
     * @covers       \toTwig\Converter\InsertConverter::convert
     * @dataProvider Provider
     *
     * @param $smarty
     * @param $twig
     */
    public function testThatIncludeIsConverted($smarty, $twig)
    {
        // Test the above cases
        /** @var \SplFileInfo $fileMock */
        $fileMock = $this->getFileMock();
        $this->assertSame($twig, $this->converter->convert($smarty));
    }

    public function Provider()
    {
        return [
            [
                '[{insert name="oxid_content" ident="foo"}]',
                '{% include "oxid_content" with {ident: "foo"} %}'
            ],
            [
                '[{ insert name="oxid_content" ident="foo" }]',
                '{% include "oxid_content" with {ident: "foo"} %}'
            ]
        ];
    }

    /**
     * @covers \toTwig\Converter\InsertConverter::getName
     */
    public function testThatHaveExpectedName()
    {
        $this->assertEquals('insert', $this->converter->getName());
    }

    /**
     * @covers \toTwig\Converter\InsertConverter::getDescription
     */
    public function testThatHaveDescription()
    {
        $this->assertNotEmpty($this->converter->getDescription());
    }

    private function getFileMock()
    {
        return $this->getMockBuilder('\SplFileInfo')->disableOriginalConstructor()->getMock();
    }
}