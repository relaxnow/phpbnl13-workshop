<?php

namespace Acme\Bundle\DicWorkshopBundle\Parser;

class XmlParser implements ParserInterface
{

    /**
     * @{inheritdoc}
     */
    public function parse($rawData)
    {
        $xml = new \SimpleXMLElement($rawData);

        $rates = array();

        foreach($xml->Cube->Cube->Cube as $node) {
            $rates[(string) $node['currency']] = (float) $node['rate'];
        }

        return $rates;
    }
}
