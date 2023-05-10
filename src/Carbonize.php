<?php

namespace Bzfvrto\Carbonize;

use Bzfvrto\Carbonize\Calculator\Calculator;
use Bzfvrto\Carbonize\Vehicle\Vehicle;

final class Carbonize
{
    protected Vehicle $vehicle;

    protected float $distance;

    protected float $footprint;

    public static function make(): self
    {
        return new self();
    }

    public function setDistance(float $distanceInMeters): self
    {
        $this->distance = $distanceInMeters;
        return $this;
    }

    public function setVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    public function calculateFootprint(): self
    {
        if (!isset($this->distance)) {
            throw new \Exception("You must set distance to be abble to calculate footprint", 1);
        }

        $this->footprint = (new Calculator(
            $this->vehicle->emission()->getCO2EquivalentInGramsPerKm(),
            $this->distance
            ))->result();
        return $this;
    }

    public function getFootprint(): float
    {
        if (! isset($this->footprint)) {
            $this->calculateFootprint();
        }
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
