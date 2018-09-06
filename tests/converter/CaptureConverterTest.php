<?php
/**
 * Created by PhpStorm.
 * User: jskoczek
 * Date: 24/08/18
 * Time: 16:11
 */

namespace sankar\ST\Tests\Converter;

use toTwig\Converter\CaptureConverter;
use PHPUnit\Framework\TestCase;

class CaptureConverterTest extends TestCase
{
    /**
     * @var CaptureConverter
     */
    protected $converter;

    public function setUp()
    {
        $this->converter = new CaptureConverter();
    }

    public function testDetectAppend()
    {
        $converted_appends = $this->converter->detectAppend('foo [{capture append="bar"');
        $this->assertTrue($converted_appends);

        $converted_appends = $this->converter->detectAppend('foo bar');
        $this->assertFalse($converted_appends);
    }

    public function testConvertAppend()
    {
        $dummySmartyTemplate = '
            [{capture append="var"}]
            bar
            [{/capture}]
        ';
        $actual = $this->converter->convertAppend($dummySmartyTemplate);
        $expected = '
            {% set var %}{{ var }}
            bar
            {% endset %}
        ';
        $this->assertEquals($expected, $actual);

        $dummySmartyTemplate = '
            [{ capture append="var" }]
            bar
            [{ /capture }]
        ';
        $actual = $this->converter->convertAppend($dummySmartyTemplate);
        $expected = '
            {% set var %}{{ var }}
            bar
            {% endset %}
        ';
        $this->assertEquals($expected, $actual);
    }

    public function testConvertCapture()
    {
        $dummySmartyTemplate = '
            [{capture name="foo"}]
            bar
            [{/capture}]
        ';
        $actual = $this->converter->convertCapture($dummySmartyTemplate);
        $expected = '
            {% set foo %}
            bar
            {% endset %}
        ';
        $this->assertEquals($expected, $actual);

        $dummySmartyTemplate = '
            [{ capture name="foo" }]
            bar
            [{ /capture }]
        ';
        $actual = $this->converter->convertCapture($dummySmartyTemplate);
        $expected = '
            {% set foo %}
            bar
            {% endset %}
        ';
        $this->assertEquals($expected, $actual);
    }

}
