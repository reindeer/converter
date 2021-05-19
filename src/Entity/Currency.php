<?php

namespace Tarandro\Entity;

use Tarandro\Contract\CurrencyInterface;

class Currency extends AbstractEntity implements CurrencyInterface
{
    public function getDate(): \DateTime
    {
        return $this->get(static::FIELD_DATE);
    }

    public function setDate(\DateTime $date): CurrencyInterface
    {
        return $this->set(static::FIELD_DATE, $date);
    }

    public function getCode(): string
    {
        return $this->get(static::FIELD_CODE);
    }

    public function setCode(string $code): CurrencyInterface
    {
        return $this->set(static::FIELD_CODE, $code);
    }

    public function getRate(): float
    {
        return $this->get(static::FIELD_RATE);
    }

    public function setRate(float $rate): CurrencyInterface
    {
        return $this->set(static::FIELD_RATE, $rate);
    }
}
