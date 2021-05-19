<?php

namespace Tarandro\Entity;

use Tarandro\Contract\RateInterface;

class Rate extends AbstractEntity implements RateInterface
{

    public function getDate(): \DateTime
    {
        return $this->get(static::FIELD_DATE);
    }

    public function setDate(\DateTime $date): RateInterface
    {
        return $this->set(static::FIELD_DATE, $date);
    }

    public function getBaseCurrency(): string
    {
        return $this->get(static::FIELD_BASE_CURRENCY);
    }

    public function setBaseCurrency(string $currency): RateInterface
    {
        return $this->set(static::FIELD_BASE_CURRENCY, $currency);
    }

    public function getTargetCurrency(): string
    {
        return $this->get(static::FIELD_TARGET_CURRENCY);
    }

    public function setTargetCurrency(string $currency): RateInterface
    {
        return $this->set(static::FIELD_TARGET_CURRENCY, $currency);
    }

    public function getRate(): float
    {
        return $this->get(static::FIELD_RATE);
    }

    public function setRate(float $rate): RateInterface
    {
        return $this->set(static::FIELD_RATE, $rate);
    }

    public function getDelta(): float
    {
        return $this->get(static::FIELD_DELTA);
    }

    public function setDelta(float $delta): RateInterface
    {
        return $this->set(static::FIELD_DELTA, $delta);
    }
}
