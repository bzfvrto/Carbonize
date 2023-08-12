<?php

namespace Bzfvrto\Carbonize\ValueObject;

final class LoadingUnit
{
    public function __construct(
        protected readonly int|float $weight, // in kg
        protected readonly Size $size
    ) {
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function getWeight(): int|float
    {
        return $this->weight;
    }
}
