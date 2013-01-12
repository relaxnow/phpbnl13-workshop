<?php

namespace Acme\Bundle\DicWorkshopBundle\Parser;

interface ParserInterface
{
    /**
     * @param string $rawData
     * @return array
     */
    function parse($rawData);
}
