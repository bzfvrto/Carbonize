<?php

namespace Bzfvrto\Carbonize;

use Bzfvrto\Carbonize\Calculator\Calculator;
use Bzfvrto\Carbonize\Vehicle\Vehicle;

final class Carbonize
{
    // protected Vehicle $vehicle;

    // protected float $distance;

    protected float $footprint;

    public function __construct(
        protected readonly Vehicle $vehicle,
        protected readonly float $distance,
    ) {
        $this->calculateFootprint();
    }

    public function calculateFootprint(): self
    {
        $this->footprint = (new Calculator(
            $this->vehicle->emission()->getCO2EquivalentInGramsPerKm(),
            $this->distance
            ))->result();
        return $this;
    }

    public function getFootprint(): float
    {
        return $this->footprint;
    }

    public function result(): float
    {
        return $this->getFootprint();
    }

    public function formatedResult(): string
    {
        return sprintf(
            '%s gramme of CO2 emited for %s km',
            round($this->getFootprint(), 3),
            round($this->distance / 1000, 2)
        );
    }
}
