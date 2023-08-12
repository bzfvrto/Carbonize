<?php

namespace Bzfvrto\Carbonize\ValueObject;

final class Capacity
{
    public function __construct(
        public readonly int|float $maxWeightAuthorized, // in kg
        public readonly int|float $maxVolumeAvailable, // in cm3
    ) {
    }
}
