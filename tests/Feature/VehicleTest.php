<?php

use Bzfvrto\Carbonize\Emission\Emission;
use Bzfvrto\Carbonize\Enum\Combustible;
use Bzfvrto\Carbonize\Enum\Country;
use Bzfvrto\Carbonize\ValueObject\Capacity;
use Bzfvrto\Carbonize\Vehicle\Vehicle;

test('it can instantiate vehicle', function () {
    $vehicle = new Vehicle(
        combustible: Combustible::E10,
        consumptionAvgInLiterFor100Km: 7.5,
        location: Country::FRANCE,
        capacity: new Capacity(1, 1)
    );

    expect($vehicle)->toBeInstanceOf(Vehicle::class);
    expect($vehicle->emission())->toBeInstanceOf(Emission::class);
    expect($vehicle->getCombustible())->toBeInstanceOf(Combustible::class);
    expect($vehicle->getCountry())->toBeInstanceOf(Country::class);
});

test('it can make vehicle', function () {
    $vehicle = Vehicle::make(
        combustible: Combustible::E10,
        consumptionAvgInLiterFor100Km: 7.5,
        location: Country::FRANCE,
        capacity: new Capacity(1, 1)
    );

    expect($vehicle)->toBeInstanceOf(Vehicle::class);
    expect($vehicle->emission())->toBeInstanceOf(Emission::class);
    expect($vehicle->getCombustible())->toBeInstanceOf(Combustible::class);
    expect($vehicle->getCountry())->toBeInstanceOf(Country::class);
});
