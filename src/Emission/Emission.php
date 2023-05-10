<?php

namespace Bzfvrto\Carbonize\Emission;

use Bzfvrto\Carbonize\ValueObject\GES;

final class Emission
{
    public function __construct(
        protected readonly GES $emission,
        protected readonly int|float $consumption
    ) {
    }

    // public function setCombustible(Combustible $combustible): self
    // {
    //     $this->combustible = $combustible;
    //     return $this;
    // }

    // public function setConsumptionAvgFor100Km(int|float $consumption): self
    // {
    //     $this->consumptionAvgPerKm = $consumption / 100;
    //     return $this;
    // }

    public function co2InGramsPerLitre(): float
    {
        return $this->emission->getCo2eInKgPerLiter() * 1000;
        // return $this->combustible->getGES()['co2'] * 1000;
    }

    public function calculateEmissionInGramsPerKm(): float
    {
        return $this->co2InGramsPerLitre() * $this->consumption;
    }

    public function getCO2EquivalentInGrammePerKm(): float
    {
        return $this->calculateEmissionInGramsPerKm();
    }
}
