<?php

namespace Bzfvrto\Carbonize\Calculator;

abstract class AbstractCalculator implements Calculator
{
    public function __construct(
        protected readonly int|float $co2PerKm, // in gramme per km
        protected readonly float $distance, // in meters
        protected readonly int|float $usedCapacity = 1, // capacity at it's maximum ( from 0 to 1 )
    ) {
    }

    public function maxGeneratedGreenhouse(): int|float
    {
        return $this->co2PerKm * ($this->distance / 1000);
    }
}
