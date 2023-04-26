<?php

namespace Bzfvrto\Carbonize;

use Bzfvrto\Carbonize\Distance\Distance;
use Bzfvrto\Carbonize\Calculator\Calculator;

final class Carbonize
{
    protected int|float $co2PerKm = 132;

    protected float $distance;

    protected float $footprint;

    public static function new(): self
    {
        return new self();
    }

    public function setDistance(float $distanceInMeters): self
    {
        $this->distance = $distanceInMeters;
        return $this;
    }

    public function setCo2PerKm(int|float $grammePerKm): self
    {
        $this->co2PerKm = $grammePerKm;
        return $this;
    }

    public function calculateFootprint(): self
    {
        if (!isset($this->distance)) {
            throw new \Exception("You must set distance to be abble to calculate footprint", 1);
        }

        $this->footprint = (new Calculator($this->co2PerKm, $this->distance))->result();

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
            round($this->footprint, 3),
            round($this->distance / 1000, 2)
        );
    }
}
