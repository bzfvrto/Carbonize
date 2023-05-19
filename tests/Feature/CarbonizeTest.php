<?php

use Bzfvrto\Carbonize\Carbonize;
use Bzfvrto\Carbonize\Distance\Distance;
use Bzfvrto\Carbonize\Enum\Combustible;
use Bzfvrto\Carbonize\Enum\Country;
use Bzfvrto\Carbonize\ValueObject\Point;
use Bzfvrto\Carbonize\Vehicle\Vehicle;

test('it can generate an formatted footprint', function () {
    $vehicle = new Vehicle(
        combustible: Combustible::E10,
        consumptionAvgInLiterFor100Km: 7.5,
        location: Country::FRANCE
    );
    $distance = Distance::make()
        ->setFrom(new Point(1, 1))
        ->setTo(new Point(2, 2));

    $footprint = new Carbonize(
        $vehicle,
        $distance->calculate()
    );

    expect(round($footprint->result(), 6))->toBe(round(31838.193821586, 6));
    expect($footprint->formatedResult())->toBeString();
});
