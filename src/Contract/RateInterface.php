<?php

namespace Tarandro\Contract;

interface RateInterface
{
    public const FIELD_DATE = 'date';

    public const FIELD_BASE_CURRENCY = 'base_currency';

    public const FIELD_TARGET_CURRENCY = 'target_currency';

    public const FIELD_RATE = 'rate';

    public const FIELD_DELTA = 'delta';

    public function getDate(): \DateTime;

    public function setDate(\DateTime $date): self;

    public function getBaseCurrency(): string;

    public function setBaseCurrency(string $currency): self;

    public function getTargetCurrency(): string;

    public function setTargetCurrency(string $currency): self;

    public function getRate(): float;

    public function setRate(float $rate): self;

    public function getDelta(): float;

    public function setDelta(float $delta): self;
}
