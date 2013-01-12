<?php

namespace Acme\Bundle\DicWorkshopBundle\Ecb;

interface ExchangeRatesInterface
{
    /**
     * @return array
     */
    public function getRates();

    /**
     * @param string $currency
     * @return float
     */
    public function getRate($currency);
}
