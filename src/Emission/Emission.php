<?php

namespace Bzfvrto\Carbonize\Emission;

use Bzfvrto\Carbonize\ValueObject\GES;

final class Emission
{
    public function __construct(
        protected readonly GES $emission,
        protected readonly int|float $consumptionInLiterPerKm
    ) {
    }

    public function co2InGramsPerLitre(): float
    {
        return $this->emission->getCo2eInKgPerLiter() * 1000;
    }

    public function calculateEmissionInGramsPerKm(): float
    {
        return $this->co2InGramsPerLitre() * $this->consumptionInLiterPerKm;
    }

    public function getCO2EquivalentInGramsPerKm(): float
    {
        return $this->calculateEmissionInGramsPerKm();
    }
}
