<?php

namespace Acme\Bundle\DicWorkshopBundle\Ecb;

use Acme\Bundle\DicWorkshopBundle\Adapter\AdapterInterface;
use Acme\Bundle\DicWorkshopBundle\Parser\ParserInterface;

class ExchangeRates implements ExchangeRatesInterface
{
    private $adapter;
    private $parser;

    public function __construct(AdapterInterface $adapter, ParserInterface $parser)
    {
        $this->adapter = $adapter;
        $this->parser = $parser;
    }

    public function getRates()
    {
        $data = $this->adapter->getRawData();

        return $this->parser->parse($data);
    }

    public function getRate($currency)
    {
        // TODO: implement

        throw new \RuntimeException('Method not implemented.');
    }
}
