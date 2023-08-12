<?php

namespace Bzfvrto\Carbonize\ValueObject;

final class Size
{
    public function __construct(
        public readonly int|float $length, // in cm
        public readonly int|float $width, // in cm
        public readonly int|float $height, // in cm
    ) {
    }

    public function volume(): float
    {
        return $this->length * $this->width * $this->height;
    }
}
