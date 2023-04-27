<?php

namespace Bzfvrto\Carbonize\Distance;

use Bzfvrto\Carbonize\Enum\Ellipsoid;
use Bzfvrto\Carbonize\ValueObject\Point;

final class Distance
{
    protected ?Point $from = null;
    protected ?Point $to = null;
    /**
     * @var Point[]
     */
    protected $steps;

    public static function new(): self
    {
        return new self;
    }

    public function setFrom(Point $point): self
    {
        $this->from = $point;
        return $this;
    }

    public function setTo(Point $point): self
    {
        $this->to = $point;
        return $this;
    }

    /**
     * @param Point[] $steps
     * @return self
     */
    public function setSteps(array $steps = []): self
    {
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
        if ($this->from === null || $this->to === null) {
            throw new \Exception("From or To can not be null", 1);
        }
        if ($this->getStepsCount() > 0) {
            $waypoints = array_merge([$this->from], $this->steps, [$this->to]);
            $lineStringArray = $this->makeLinestringArrayFromWaypoints($waypoints);

            return $this->addDistance($lineStringArray);
        }
        return $this->haversine($this->from, $this->to);
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

    // protected function isValid(): void
    // {
    //     if ($this->from === null || $this->to === null) {
    //         throw new \Exception("From or To can not be null", 1);
    //     }

    //     if(!$this->from instanceof Point || !$this->to instanceof Point){
    //         throw new \Exception("From or To are undefined", 1);
    //     };
    // }

    protected function getRadiusFromEllipsoid(): float
    {
        $ellipsoid = Ellipsoid::WSG84->data();

        return (float) $ellipsoid['radius'] * (1 - 1 / $ellipsoid['invFlattening'] / 3);
    }
}
