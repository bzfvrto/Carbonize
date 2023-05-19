<?php

namespace Bzfvrto\Carbonize\Emission;

use Bzfvrto\Carbonize\Enum\Combustible;
use Bzfvrto\Carbonize\Enum\Country;
use Bzfvrto\Carbonize\Support\Reader;
use Bzfvrto\Carbonize\ValueObject\GES;

final class Emission
{
    public function __construct(
        protected readonly Combustible $combustible,
        protected readonly int|float $consumptionInLiterPerKm,
        protected readonly Country $location
    ) {
    }

    public function gesProvider(): Reader
    {
        return $this->location->getGESProvider();
    }

    public function getGES(): GES
    {
        $data = $this->gesProvider()->find($this->combustible->value);

        return new GES(
            kgCO2equivalentPerLiter: (float) $data[0]['Total poste non décomposé'],
            kgCO2fPerLiter: (float) array_values($data[0])[0],
            kgCH4PerLiter: (float) $data[0]['CH4f'],
            kgN2OPerLiter: (float) $data[0]['N2O']
        );
    }

    public function co2InGramsPerLitre(): float
    {
        return $this->getGES()->getCo2eInKgPerLiter() * 1000;
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
