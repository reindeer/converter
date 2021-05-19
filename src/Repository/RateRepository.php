<?php

namespace Tarandro\Repository;

use Tarandro\Entity\Rate;

class RateRepository
{
    public function __construct(
        protected CurrencyRepository $currencyRepository,
    ) {
    }

    public function get(string $baseCode, string $targetCode, \DateTime $date)
    {
        $prevDate = (clone $date)->modify('-1day');
        $prevBaseCurrency = $this->currencyRepository->get($baseCode, $prevDate);
        $prevTargetCurrency = $this->currencyRepository->get($targetCode, $prevDate);
        $currentBaseCurrency = $this->currencyRepository->get($baseCode, $date);
        $currentTargetCurrency = $this->currencyRepository->get($targetCode, $date);
        return (new Rate())
            ->setBaseCurrency($baseCode)
            ->setTargetCurrency($targetCode)
            ->setDate($date)
            ->setRate($currentTargetCurrency->getRate() / $currentBaseCurrency->getRate())
            ->setDelta($currentTargetCurrency->getRate() / $currentBaseCurrency->getRate() - $prevTargetCurrency->getRate() / $prevBaseCurrency->getRate());
    }
}
