<?php

namespace Bzfvrto\Carbonize\Enum;

enum Ellipsoid
{
    case INTERNATIONAL;
    case WSG84;

    /**
     * @return array<string, float|string>
     */
    public function data(): array
    {
        return match($this) {
            self::INTERNATIONAL => [
                'name' => 'International',
                'radius'    => 6378388.0,
                'invinvFlatteningF' => 297.0,
            ],
            self::WSG84 => [
                'name' => 'WGS 84',
                'radius' => 6378137.0,
                'invFlattening' => 298.257223563,
            ],
        };
    }
}
