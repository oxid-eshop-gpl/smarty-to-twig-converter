<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace toTwig\Tests\Unit;

use toTwig\Converter\OxhasrightsConverter;

/**
 * Class OxhasrightsConverterTest
 */
class OxhasrightsConverterTest extends FileConversionUnitTestCase
{

    /** @var OxhasrightsConverter */
    protected $converter;

    public function setUp(): void
    {
        $this->converter = new OxhasrightsConverter();
        $this->templateNames = ['oxhasrights'];
        parent::setUp();
    }

    /**
     * @covers       \toTwig\Converter\OxhasrightsConverter::convert
     *
     * @dataProvider provider
     *
     * @param $smarty
     * @param $twig
     */
    public function testThatForIsConverted($smarty, $twig)
    {
        // Test the above cases
        $this->assertSame(
            $twig,
            $this->converter->convert($smarty)
        );
    }

    /**
     * @return array
     */
    public function provider()
    {
        return [
            //basic usage
            [
                '[{oxhasrights object=$edit readonly=$readonly}]',
                '{% hasrights { object: edit, readonly: readonly } %}'
            ],
            //spaces in tags
            [
                '[{ oxhasrights type=$type }]',
                '{% hasrights { type: type } %}'
            ]
        ];
    }

    /**
     * @covers \toTwig\Converter\OxhasrightsConverter::getName
     */
    public function testThatHaveExpectedName()
    {
        $this->assertEquals('oxhasrights', $this->converter->getName());
    }

    /**
     * @covers \toTwig\Converter\OxhasrightsConverter::getDescription
     */
    public function testThatHaveDescription()
    {
        $this->assertNotEmpty($this->converter->getDescription());
    }
}
