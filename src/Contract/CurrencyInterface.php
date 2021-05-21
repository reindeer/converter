<?php

namespace Tarandro\Contract;

interface CurrencyInterface
{
    public const BASE_CURRENCY = 'RUR';

    public const FIELD_DATE = 'date';

    public const FIELD_CODE = 'code';

    public const FIELD_RATE = 'rate';

    public function getDate(): \DateTime;

    public function setDate(\DateTime $date): self;

    public function getCode(): string;

    public function setCode(string $rate): self;

    public function getRate(): float;

    public function setRate(float $rate): self;
}
