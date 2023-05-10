<?php

namespace Bzfvrto\Carbonize\ValueObject;

final class GES
{
    public function __construct(
        protected readonly int|float $kgCO2equivalentPerLiter,
        // protected int|float $kgCO2PerLiter,
        // protected int|float $kgCH4PerLiter,
        // protected int|float $kgN2OPerLiter,
        // protected int|float $kgSF6PerLiter,
        // protected int|float $kgNF3PerLiter,
    ) {
    }

    public function getCo2eInKgPerLiter(): int|float
    {
        return $this->kgCO2equivalentPerLiter;
    }
}