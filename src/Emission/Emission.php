<?php

namespace Bzfvrto\Carbonize\Emission;

use Bzfvrto\Carbonize\Enum\Combustible;
use Bzfvrto\Carbonize\Enum\Country;
use Bzfvrto\Carbonize\Support\Reader;
use Bzfvrto\Carbonize\ValueObject\GreenhouseGas;

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
        return $this->location->getGreenhouseGasProvider();
    }

    public function getGreenhouseGas(): GreenhouseGas
    {
        /** @var \Bzfvrto\Carbonize\DTO\GasEmited $data */
        $data = $this->gesProvider()->find($this->combustible->value);

        return new GreenhouseGas(
            kgCO2equivalentPerLiter: $data->co2equivalent,
            kgCO2fPerLiter: $data->co2f,
            kgCH4PerLiter: $data->ch4f,
            kgN2OPerLiter: $data->n2o
        );
    }

    public function co2InGramsPerLitre(): float
    {
        return $this->getGreenhouseGas()->getCo2eInKgPerLiter() * 1000;
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
