<?php

use Bzfvrto\Carbonize\Distance\Distance;
use Bzfvrto\Carbonize\ValueObject\Point;

test('it can calculate distance between two or more points', function () {
    $distance = Distance::make()
                ->setFrom(new Point(1, 2))
                ->setTo(new Point(4, 5));

    expect($distance)->toBeInstanceOf(Distance::class);
    expect(round($distance->calculate(), 6))->toEqual(round(471509.20218695, 6));

    $distance->setSteps([new Point(1,3), new Point(2, 4)]);

    expect(round($distance->calculate(), 6))->toEqual(round(516972.895251, 6));
});

test('it fail if steps contain unvalid data', function () {
    $distance = Distance::make()
                ->setFrom(new Point(1, 2))
                ->setTo(new Point(4, 5))
                ->setSteps([new Point(2,3), 'NotAPoint(4, 2)']);
})->throws(Exception::class, "[NotAPoint(4, 2)] must be an instance of Point");
