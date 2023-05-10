<?php

namespace Bzfvrto\Carbonize\Enum;

use Bzfvrto\Carbonize\ValueObject\GES;

enum Combustible
{
    case DIESEL; // B30
    case ESSENCE;
    case GNL;
    // case GAS;

    public function getGES(): GES
    {
        return match($this) {
            self::DIESEL => new GES(
                2.63, // kgCO2e/L
                // 'ch4' => ,
                // 'n2o' => ,
                // 'sf6' => ,
                // 'nf3' => ,
            ),
            self::ESSENCE => new GES(
                2.70, // kgCO2e/L
                // 'ch4' => ,
                // 'n2o' => ,
                // 'sf6' => ,
                // 'nf3' => ,
            ),
            self::GNL => new GES(
                3.28, // kgCO2e/L
            )
        };
    }
}
