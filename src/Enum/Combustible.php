<?php

namespace Bzfvrto\Carbonize\Enum;

use Bzfvrto\Carbonize\Support\CSVReader;
use Bzfvrto\Carbonize\ValueObject\GES;

enum Combustible: string
{
    case B30 = 'B30'; // Diesel
    case B7 = 'B7'; // Diesel
    case E10 = 'E10'; // Essence
    case E85 = 'E85'; // Essence
    case SUPER = 'SUPER'; // Essence

    public function getGES(): GES
    {
        $reader = new CSVReader(
            __DIR__.'/../../assets/base-carboner_combustible.csv'
        );

        $data = $reader->find($this->value);

        return new GES(
            kgCO2equivalentPerLiter: (int) $data[0]['Total poste non décomposé'],
            kgCO2fPerLiter: (int) array_values($data[0])[0],
            kgCH4PerLiter: (int) $data[0]['CH4f'],
            kgN2OPerLiter: (int) $data[0]['N2O']
        );
    }
}
