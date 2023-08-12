<?php

namespace Bzfvrto\Carbonize\Calculator\Formula;

use Bzfvrto\Carbonize\Calculator\AbstractCalculator;

final class KnownEnergyOneBeneficary extends AbstractCalculator
{
    public function result(): float
    {
        return $this->maxGeneratedGreenhouse();
    }
}
