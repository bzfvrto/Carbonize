<?php

namespace Bzfvrto\Carbonize\Enum;

use Bzfvrto\Carbonize\Support\CSVAdemeReader;
use Bzfvrto\Carbonize\Support\Reader;

enum Country
{
    case FRANCE;

    public function getGESProvider(): Reader
    {
        return match($this) {
            self::FRANCE => new CSVAdemeReader(
                __DIR__.'/../../assets/base-carboner_combustible.csv'
            ),
        };
    }
}
