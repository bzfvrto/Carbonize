<?php

namespace Bzfvrto\Carbonize\Vehicle;

use Bzfvrto\Carbonize\Emission\Emission;
use Bzfvrto\Carbonize\Enum\Combustible;
use Bzfvrto\Carbonize\Enum\Country;

final class Vehicle
{
    public function __construct(
        protected readonly Combustible $combustible,
        protected readonly int|float $consumptionAvgInLiterFor100Km = 0,
        protected readonly Country $location = Country::FRANCE
    ) {
    }

    public function getCombustible(): Combustible
    {
        return $this->combustible;
    }

    public function getCountry(): Country
    {
        return $this->location;
    }

    public function emission(): Emission
    {
        return new Emission(
            $this->getCombustible(),
            $this->consumptionAvgInLiterFor100Km / 100,
            $this->getCountry()
        );
    }

    public static function make(
        Combustible $combustible,
        int|float $consumptionAvgInLiterFor100Km = 0,
        Country $location = Country::FRANCE
    ): self {
        return new self($combustible, $consumptionAvgInLiterFor100Km, $location);
    }
}
