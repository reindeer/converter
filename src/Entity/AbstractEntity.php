<?php

namespace Tarandro\Entity;

use Tarandro\Exception\ValidationException;

abstract class AbstractEntity
{
    public function __construct(
        protected array $data = [],
    ) {
    }

    protected function get(string $key)
    {
        return $this->data[$key] ?? throw new ValidationException(sprintf('Value %s is not set', $key));
    }

    protected function set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }
}
