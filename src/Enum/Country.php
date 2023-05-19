<?php

namespace Bzfvrto\Carbonize\Enum;

use Bzfvrto\Carbonize\Support\CSVReader;
use Bzfvrto\Carbonize\Support\Reader;

enum Country
{
    case FRANCE;

    public function getGESProvider(): Reader
    {
        return match($this) {
            self::FRANCE => new CSVReader(
                __DIR__.'/../../assets/base-carboner_combustible.csv'
            ),
        };
    }
}
