<?php

namespace Tarandro\Exception;

use Throwable;

class CurrencyNotFoundException extends \Exception
{
    protected string $currencyCode;

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $code): self
    {
        $this->currencyCode = $code;
        return $this;
    }
}
