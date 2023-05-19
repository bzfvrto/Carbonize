<?php

namespace Bzfvrto\Carbonize\DTO;

class GasEmited
{
    public function __construct(
        public readonly int|float $co2equivalent,
        public readonly int|float $co2f,
        public readonly int|float $ch4f,
        public readonly int|float $ch4b,
        public readonly int|float $n2o,
        public readonly int|float $co2b,
        public readonly null|int|float $otherGES,
        public readonly string $type, // amont, combustion, total
        public readonly string $baseName,
        public readonly string $attributName,
        public readonly string $unitFr,
        public readonly string $unitEn,
        public readonly string $contributor,
        public readonly string $localisation,
        public readonly string $validUntil
    ) {
    }
}
