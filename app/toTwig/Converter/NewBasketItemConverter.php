<?php

/**
 * This file is part of the PHP ST utility.
 *
 * (c) Sankar suda <sankar.suda@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace toTwig\Converter;

/**
 * Class InsertTrackerConverter
 *
 * @package toTwig\Converter
 */
class NewBasketItemConverter extends ConverterAbstract
{
    protected string $name = 'oxid_newbasketitem';
    protected string $description = 'Convert insert oxid_newbasketitem to twig new_basket_item';
    protected int $priority = 110;

    protected string $pattern;
    protected string $string = '{{ insert_new_basket_item(:vars) }}';
    protected string $attrName = 'name';

    /**
     * NewBasketItemConverter constructor.
     */
    public function __construct()
    {
        $this->pattern = $this->getOpeningTagPattern('insert');
    }

    public function convert(string $content): string
    {
        $pattern = $this->pattern;
        $string = $this->string;
        $name = $this->name;

        return preg_replace_callback(
            $pattern,
            function ($matches) use ($string, $name) {
                $attr = $this->getAttributes($matches);

                $replace = [];
                $templateName = $this->sanitizeVariableName($attr[$this->attrName]);
                if ($templateName != $name) {
                    return $matches[0];
                }

                $replace['template'] = $attr[$this->attrName];

                if (isset($attr['insert'])) {
                    unset($attr['insert']);
                }

                // If we have any other variables
                if (count($attr) > 1) {
                    $replace['with'] = 'with';
                    unset($attr[$this->attrName]); // We won't need in vars

                    $vars = [];
                    foreach ($attr as $key => $value) {
                        $valueWithConvertedFileExtension = $this->convertFileExtension($this->sanitizeValue($value));
                        $vars[] = $this->sanitizeVariableName($key) . ": " . $valueWithConvertedFileExtension;
                    }

                    $replace['vars'] = '{' . implode(', ', $vars) . '}';
                }

                $string = $this->replaceNamedArguments($string, $replace);

                return str_replace($matches[0], $string, $matches[0]);
            },
            $content
        );
    }
}
