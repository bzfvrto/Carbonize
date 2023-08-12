<?php

namespace Bzfvrto\Carbonize\Enum;

use Bzfvrto\Carbonize\Calculator\Calculator;
use Bzfvrto\Carbonize\Calculator\Formula\KnownEnergyOneBeneficary;
use Bzfvrto\Carbonize\Calculator\Formula\KnownEnergySeveralBeneficiaries;
use Bzfvrto\Carbonize\Vehicle\Vehicle;

enum Formula: string
{
    case FORMULA1 = 'KnownEnergyOneBeneficary';
    case FORMULA2 = 'KnownEnergySeveralBeneficiaries';
    case FORMULA3 = 'UnKnownEnergyOneBeneficary';
    case FORMULA4 = 'UnKnownEnergySeveralBeneficiaries';

    public function makeCalculator(Vehicle $vehicle, float $distance): Calculator
    {
        return match($this) {
            self::FORMULA1 => new KnownEnergyOneBeneficary(
                $vehicle->emission()->getCO2EquivalentInGramsPerKm(),
                $distance
            ),
            self::FORMULA2 => $this->formula2Calculator($vehicle, $distance),
            default => new KnownEnergyOneBeneficary($vehicle->emission()->getCO2EquivalentInGramsPerKm(), $distance),
        };
    }

    public function formula2Calculator(Vehicle $vehicle, int|float $distance)
    {
        $calculators = [];

        foreach ($vehicle->getCharge() as $charge) {
            $calculators[] = (new KnownEnergySeveralBeneficiaries(
                $vehicle->emission()->getCO2EquivalentInGramsPerKm(),
                $distance,
                $vehicle->usedCapacityFor($charge)
            ))->result();
        }

        return dd($calculators);
    }
}
