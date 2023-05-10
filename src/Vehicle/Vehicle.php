<?php

namespace Bzfvrto\Carbonize\Vehicle;

use Bzfvrto\Carbonize\Emission\Emission;
use Bzfvrto\Carbonize\Enum\Combustible;

final class Vehicle
{
    protected Combustible $combustible;

    protected int|float $consumptionAvgInLiterFor100Km = 0;

    public function setCombustible(Combustible $combustible): self
    {
        $this->combustible = $combustible;
        return $this;
    }

    public function setConsumptionAvgFor100Km(int|float $consumption): self
    {
        $this->consumptionAvgInLiterFor100Km = $consumption;
        return $this;
    }

    public function emission(): Emission
    {
        if (! isset($this->combustible)) {
            throw new \Exception("You must set combustible in order to be abble to calculate emission", 1);

        }
        return new Emission(
            $this->combustible->getGES(),
            $this->consumptionAvgInLiterFor100Km / 100
        );
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