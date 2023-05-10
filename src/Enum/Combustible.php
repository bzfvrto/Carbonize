<?php

namespace Bzfvrto\Carbonize\Enum;

enum Combustible
{
    case DIESEL; // B30
    case ESSENCE;
    case GNL;
    // case GAS;

    /**
     * @return array<string, int|float|null>
     */
    public function getGES(): array
    {
        return match($this) {
            self::DIESEL => [
                'co2' => 2.63, // kgCO2e/L
                // 'ch4' => ,
                // 'n2o' => ,
                // 'sf6' => ,
                // 'nf3' => ,
            ],
            self::ESSENCE => [
                'co2' => 2.70, // kgCO2e/L
                // 'ch4' => ,
                // 'n2o' => ,
                // 'sf6' => ,
                // 'nf3' => ,
            ],
            self::GNL => [
                'co2' => 3.28, // kgCO2e/L
            ]
        };
    }
}
