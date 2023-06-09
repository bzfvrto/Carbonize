<?php

use Bzfvrto\Carbonize\ValueObject\GreenhouseGas;

test('it can instantiate GreenhouseGas and return values', function () {
    $ges = new GreenhouseGas(
        kgCO2equivalentPerLiter: 1.5,
        kgCO2fPerLiter: 2,
        kgCH4PerLiter: 2.75,
        kgN2OPerLiter: 4
    );

    expect($ges)->toBeInstanceOf(GreenhouseGas::class);
    expect($ges->getCo2eInKgPerLiter())->toBe(1.5);
    expect($ges->getCo2fInKgPerLiter())->toBe(2);
    expect($ges->getCH4InKgPerLiter())->toBe(2.75);
    expect($ges->getN2OInKgPerLiter())->toBe(4);
});
