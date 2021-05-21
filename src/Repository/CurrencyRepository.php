<?php

namespace Tarandro\Repository;

use Tarandro\Contract\CurrencyResourceInterface;
use Tarandro\Entity\Currency;

class CurrencyRepository
{
    public function __construct(
        protected CurrencyResourceInterface $currencyResource,
    ) {
    }

    public function get(string $currency, \DateTime $date): Currency
    {
        $data = $this->currencyResource->fetch($currency, $date);
        return new Currency($data);
    }
}
