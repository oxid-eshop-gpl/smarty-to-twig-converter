<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace toTwig\Tests\Unit;

use PHPUnit\Framework\TestCase;
use toTwig\Converter\OxifcontentConverter;

/**
 * Class OxifcontentConverterTest
 */
class OxifcontentConverterTest extends TestCase
{

    /** @var OxifcontentConverter */
    protected $converter;

    public function setUp(): void
    {
        $this->converter = new OxifcontentConverter();
    }

    /**
     * @covers       \toTwig\Converter\OxifcontentConverter::convert
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
            // Basic usage
            [
                "[{oxifcontent ident=\"TOBASKET\" object=\"aObject\"}]\nfoo\n[{/oxifcontent}]",
                "{% ifcontent ident \"TOBASKET\" set aObject %}\nfoo\n{% endifcontent %}"
            ],
            // Values converting
            [
                "[{oxifcontent ident=\$x object=\"y\"}]\nfoo\n[{/oxifcontent}]",
                "{% ifcontent ident x set y %}\nfoo\n{% endifcontent %}"
            ],
            // Assignment
            [
                "[{oxifcontent ident=\"TOBASKET\" object=\"aObject\" assign=\$var}]\nfoo\n[{/oxifcontent}]",
                "{% set var %}{% ifcontent ident \"TOBASKET\" set aObject %}\nfoo\n{% endifcontent %}{% endset %}"
            ],
            // With spaces
            [
                "[{ oxifcontent ident=\"TOBASKET\" object=\"aObject\" }]\nfoo\n[{ /oxifcontent }]",
                "{% ifcontent ident \"TOBASKET\" set aObject %}\nfoo\n{% endifcontent %}"
            ]
        ];
    }

    /**
     * @covers \toTwig\Converter\OxifcontentConverter::getName
     */
    public function testThatHaveExpectedName()
    {
        $this->assertEquals('oxifcontent', $this->converter->getName());
    }

    /**
     * @covers \toTwig\Converter\OxifcontentConverter::getDescription
     */
    public function testThatHaveDescription()
    {
        $this->assertNotEmpty($this->converter->getDescription());
    }
}
