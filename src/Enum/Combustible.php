<?php

namespace Bzfvrto\Carbonize\Enum;

use Bzfvrto\Carbonize\Support\CSVReader;
use Bzfvrto\Carbonize\ValueObject\GreenhouseGas;

enum Combustible: string
{
    case B30 = 'B30'; // Diesel
    case B7 = 'B7'; // Diesel
    case E10 = 'E10'; // Essence
    case E85 = 'E85'; // Essence
    case SUPER = 'SUPER'; // Essence
}
