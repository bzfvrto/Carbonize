<?php

namespace Bzfvrto\Carbonize\Vehicle;

use Bzfvrto\Carbonize\Emission\Emission;
use Bzfvrto\Carbonize\Enum\Combustible;

final class Vehicle
{
    protected ?Combustible $combustible;

    protected int|float $consumptionAvgPerKm = 0;

    public function setCombustible(Combustible $combustible): self
    {
        $this->combustible = $combustible;
        return $this;
    }

    public function setConsumptionAvgFor100Km(int|float $consumption): self
    {
        $this->consumptionAvgPerKm = $consumption / 100;
        return $this;
    }

    public function emission(): Emission
    {
        return new Emission($this->combustible->getGES(), $this->consumptionAvgPerKm);
    }

    // public function calculateEmissionPerGrammePerLitre()
    // {
    //     return $this->combustible->getGES()['co2'] * 1000;
    // }

    // public function calculateEmissionPerGrammePerKm()
    // {
    //     if ($this->consumptionAvgPerKm === null) {
    //         throw new \Exception("Consumption average per km is null", 1);
    //     }

    //     return $this->calculateEmissionPerGrammePerLitre() * $this->consumptionAvgPerKm;
    // }

    // public function getCO2EquivalentInGrammePerKm(): float
    // {
    //     return $this->calculateEmissionPerGrammePerKm();
    // }

    public static function make(): self
    {
        return new self;
    }
}
