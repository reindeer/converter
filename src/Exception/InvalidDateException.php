<?php

namespace Tarandro\Exception;

class InvalidDateException extends \Exception
{
    protected \DateTime $date;

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }
}
