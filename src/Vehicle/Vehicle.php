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

    public static function make(): self
    {
        return new self;
    }
}
