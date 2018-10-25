<?php

namespace toTwig\Converter;

use toTwig\AbstractSingleTagConverter;

/**
 * Class OxmultilangConverter
 *
 * @author Tomasz Kowalewski (t.kowalewski@createit.pl)
 */
class OxmultilangConverter extends AbstractSingleTagConverter
{

    protected $name = 'oxmultilang';
    protected $description = "Convert smarty {oxmultilang} to twig function {{ oxmultilang() }}";
    protected $priority = 100;
}