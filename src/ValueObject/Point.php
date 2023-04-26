<?php

namespace Bzfvrto\Carbonize\ValueObject;

final class Point
{
    public function __construct(
        protected int|float $latitude,
        protected int|float $longitude,
    ) {
    }

    public function getLatitude(): int|float
    {
        return $this->latitude;
    }

    public function getLongitude(): int|float
    {
        return $this->longitude;
    }
}
