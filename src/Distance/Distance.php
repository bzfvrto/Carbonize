<?php

namespace Bzfvrto\Carbonize\Distance;

use Bzfvrto\Carbonize\Enum\Ellipsoid;
use Bzfvrto\Carbonize\ValueObject\Point;

final class Distance
{
    /**
     * @var Point[]
     */
    protected $steps;

    public function __construct(
        protected readonly Point $from,
        protected readonly Point $to
    ) {
    }

    /**
     * @param Point[] $steps
     * @return self
     */
    public function setSteps(array $steps = []): self
    {
        $this->validateSteps($steps);

        $this->steps = $steps;
        return $this;
    }

    public function getStepsCount(): int
    {
        if($this->steps) {
            return count($this->steps);
        }
        return 0;
    }

    public function calculate(): float
    {
        if ($this->hasSteps()) {
            $waypoints = array_merge([$this->from], $this->steps, [$this->to]);
            $lineStringArray = $this->makeLinestringArrayFromWaypoints($waypoints);

            return $this->addDistance($lineStringArray);
        }
        return $this->haversine($this->from, $this->to);
    }

    protected function hasSteps(): bool
    {
        return $this->getStepsCount() > 0;
    }

    /**
     * @param Point[] $steps
     * @return void
     */
    protected function validateSteps(array $steps): void
    {
        foreach ($steps as $step) {
            if (!$step instanceof Point) {
                throw new \Exception("[$step] must be an instance of Point", 1);
            }
        }
    }

    /**
     * @param Point[] $waypoints
     * @return array<Point[]>
     */
    protected function makeLinestringArrayFromWaypoints(array $waypoints): array
    {
        $lineStringArray = [];
        $itemCount = count($waypoints);

        foreach ($waypoints as $key => $coordinate) {
            if ($key < $itemCount - 1) {
                $nextItem = $waypoints[++$key];
                $lineStringArray[] = [$coordinate, $nextItem];
            }
        }

        return $lineStringArray;
    }

    /**
     * @param array<Point[]> $lineStringArray
     */
    protected function addDistance(array $lineStringArray): float
    {
        $sumOfDistance = 0;

        foreach ($lineStringArray as $lineString) {
            $sumOfDistance += $this->haversine($lineString[0], $lineString[1]);
        }

        return $sumOfDistance;
    }

    protected function haversine(Point $from, Point $to): float
    {
        $fromLat = deg2rad($from->getLatitude());
        $toLat = deg2rad($to->getLatitude());
        $fromLng = deg2rad($from->getLongitude());
        $toLng = deg2rad($to->getLongitude());

        $deltaLat = $toLat - $fromLat;
        $deltaLng = $toLng - $fromLng;
        $a = (sin($deltaLat / 2) ** 2) + cos($fromLat) * cos($toLat) * (sin($deltaLng / 2) ** 2);
        $c = 2 * asin(sqrt($a));

        $radius = $this->getRadiusFromEllipsoid();

        return $radius * $c;
    }

    protected function getRadiusFromEllipsoid(): float
    {
        $ellipsoid = Ellipsoid::WSG84->data();

        return (float) $ellipsoid['radius'] * (1 - 1 / $ellipsoid['invFlattening'] / 3);
    }
}
