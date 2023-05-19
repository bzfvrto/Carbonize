<?php

namespace Bzfvrto\Carbonize\ValueObject;

final class GES
{
    public function __construct(
        protected readonly int|float $kgCO2equivalentPerLiter,
        protected readonly int|float $kgCO2fPerLiter,
        protected readonly int|float $kgCH4PerLiter,
        protected readonly int|float $kgN2OPerLiter,
    ) {
    }

    public function getCo2eInKgPerLiter(): int|float
    {
        return $this->kgCO2equivalentPerLiter;
    }

    public function getCo2fInKgPerLiter(): int|float
    {
        return $this->kgCO2fPerLiter;
    }

    public function getCH4InKgPerLiter(): int|float
    {
        return $this->kgCH4PerLiter;
    }

    public function getN2OInKgPerLiter(): int|float
    {
        return $this->kgN2OPerLiter;
    }
}
