<?php

use Bzfvrto\Carbonize\Emission\Emission;
use Bzfvrto\Carbonize\Enum\Combustible;
use Bzfvrto\Carbonize\Enum\Country;
use Bzfvrto\Carbonize\ValueObject\GreenhouseGas;
use Bzfvrto\Carbonize\Vehicle\Vehicle;

test('it can instantiate emission', function () {
    $emission = new Emission(
        Combustible::E10,
        0.075,
        Country::FRANCE
    );

    expect($emission)->toBeInstanceOf(Emission::class);
    expect($emission->getGreenhouseGas())->toBeInstanceOf(GreenhouseGas::class);

    expect($emission->co2InGramsPerLitre())->toBeFloat();
    expect($emission->co2InGramsPerLitre())->toBe(2700.0);

    expect($emission->getCO2EquivalentInGramsPerKm())->toBe(202.5);
});

test('it can get emission for combustible super', function () {
    $emission = new Emission(
        Combustible::SUPER,
        0.075,
        Country::FRANCE
    );

    expect($emission)->toBeInstanceOf(Emission::class);
    expect($emission->getGreenhouseGas())->toBeInstanceOf(GreenhouseGas::class);
});
