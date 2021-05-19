<?php

namespace Tarandro\Contract;

interface CurrencyResourceInterface
{
    public function fetch(string $code, \DateTime $date): array;
}
