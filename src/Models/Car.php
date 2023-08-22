<?php

namespace Temperworks\Codechallenge\Models;

class Car
{
    public function __construct(private string $licensePlate)
    {
    }

    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }
}
