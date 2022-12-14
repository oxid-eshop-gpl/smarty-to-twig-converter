<?php

/**
 * This file is part of the PHP ST utility.
 *
 * (c) sankar suda <sankar.suda@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace toTwig\Tests\Unit;

use PHPUnit\Framework\TestCase;
use toTwig\Converter\AssignConverter;

/**
 * @author sankara <sankar.suda@gmail.com>
 */
class AssignConverterTest extends TestCase
{

    /** @var AssignConverter */
    protected $converter;

    public function setUp(): void
    {
        $this->converter = new AssignConverter();
    }

    /**
     * @covers       \toTwig\Converter\AssignConverter::convert
     * @dataProvider provider
     */
    public function testThatAssignIsConverted($smarty, $twig)
    {
        // Test the above cases
        $this->assertSame(
            $twig,
            $this->converter->convert($smarty)
        );
    }

    public function provider()
    {
        return [
            [
                "[{assign var=\"name\" value=\"Bob\"}]",
                "{% set name = \"Bob\" %}"
            ],
            [
                "[{assign var=\"name\" value=\$bob}]",
                "{% set name = bob %}"
            ],
            [
                "[{assign \"name\" \"Bob\"}]",
                "{% set name = \"Bob\" %}"
            ],
            [
                "[{assign var=\"foo\" \"bar\" scope=\"global\"}]",
                "{% set foo = \"bar\" %}"
            ],
            [
                "[{assign var=\"where\" value=\$oView->getListFilter()}]",
                "{% set where = oView.getListFilter() %}"
            ],
            [
                "[{assign var=\"template_title\" value=\"MY_WISH_LIST\"|oxmultilangassign}]",
                "{% set template_title = \"MY_WISH_LIST\"|translate %}"
            ]
        ];
    }

    /**
     * @covers \toTwig\Converter\AssignConverter::getName
     */
    public function testThatHaveExpectedName()
    {
        $this->assertEquals('assign', $this->converter->getName());
    }

    /**
     * @covers \toTwig\Converter\AssignConverter::getDescription
     */
    public function testThatHaveDescription()
    {
        $this->assertNotEmpty($this->converter->getDescription());
    }
}
