<?php

namespace Bzfvrto\Carbonize\Calculator\Formula;

use Bzfvrto\Carbonize\Calculator\AbstractCalculator;

final class KnownEnergySeveralBeneficiaries extends AbstractCalculator
{
    public function result(): float
    {
        return $this->maxGeneratedGreenhouse() * $this->usedCapacity;
    }
}
