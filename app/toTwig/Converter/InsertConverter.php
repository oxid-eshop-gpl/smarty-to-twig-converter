<?php
/**
 * Created by PhpStorm.
 * User: jskoczek
 * Date: 28/08/18
 * Time: 12:34
 */

namespace toTwig\Converter;

class InsertConverter extends IncludeConverter
{
    protected $pattern = '/\[\{insert\b\s*([^{}]+)?\}\]/';
    protected $string = '{% include :template :with :vars %}';
    protected $attrName = 'name';

    public function getName()
    {
        return 'insert';
    }

    public function getDescription()
    {
        return 'Convert smarty insert to twig include';
    }
}