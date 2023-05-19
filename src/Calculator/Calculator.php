<?php

namespace Bzfvrto\Carbonize\Calculator;

final class Calculator
{
    public function __construct(
        protected readonly int|float $co2PerKm, // in gramme per km
        protected readonly float $distance // in meters
    ) {
    }

    public function result(): float
    {
        return $this->co2PerKm * ($this->distance / 1000);
    }

    public function formatedResult(): string
    {
        return sprintf(
            '%s gramme of CO2 emited for %s km',
            round($this->result(), 3),
            round($this->distance / 1000, 2)
        );
    }
}
