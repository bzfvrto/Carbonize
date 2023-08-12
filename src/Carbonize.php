<?php

namespace Bzfvrto\Carbonize;

use Bzfvrto\Carbonize\Calculator\Calculator;
use Bzfvrto\Carbonize\Calculator\Formula\KnownEnergyOneBeneficary;
use Bzfvrto\Carbonize\Enum\Formula;
use Bzfvrto\Carbonize\Vehicle\Vehicle;

final class Carbonize
{
    // protected Vehicle $vehicle;

    // protected float $distance;

    protected float $footprint;

    public function __construct(
        protected readonly Vehicle $vehicle,
        protected readonly float $distance,
        protected readonly Formula $formula = Formula::FORMULA1,
    ) {
        $this->calculateFootprint();
    }

    // public function setFormula(Formula $formula): self
    // {
    //     $this->formula = $formula;
    //     return $this;
    // }

    public function calculateFootprint(): self
    {
        $this->footprint = $this->formula->makeCalculator(
                $this->vehicle,
                $this->distance
            )->result();
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
        if ($this->vehicle->hasCharge() && count($this->vehicle->getCharge()) > 1) {
            return sprintf(
                '%s gramme of CO2 emited for %s km by package',
                round($this->getFootprint(), 3),
                round($this->distance / 1000, 2),
                // $this->vehicle->getCharge()
            );
        }
        return sprintf(
            '%s gramme of CO2 emited for %s km',
            round($this->getFootprint(), 3),
            round($this->distance / 1000, 2)
        );
    }
}
