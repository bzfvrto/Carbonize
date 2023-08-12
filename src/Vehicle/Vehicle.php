<?php

namespace Bzfvrto\Carbonize\Vehicle;

use Bzfvrto\Carbonize\Emission\Emission;
use Bzfvrto\Carbonize\Enum\Combustible;
use Bzfvrto\Carbonize\Enum\Country;
use Bzfvrto\Carbonize\ValueObject\Capacity;
use Bzfvrto\Carbonize\ValueObject\LoadingUnit;

final class Vehicle
{
    public function __construct(
        protected readonly Combustible $combustible,
        protected readonly int|float $consumptionAvgInLiterFor100Km,
        protected readonly Capacity $capacity,
        protected readonly Country $location = Country::FRANCE,
        /** @var array<int, LoadingUnit> $charge */
        protected array $charge = []
    ) {
    }

    public function getCombustible(): Combustible
    {
        return $this->combustible;
    }

    public function getCountry(): Country
    {
        return $this->location;
    }

    public function getCapacity(): Capacity
    {
        return $this->capacity;
    }

    /**
     * @param LoadingUnit|array<int, LoadingUnit> $charges
     */
    public function setCharge(array|LoadingUnit $charges): self
    {
        if (is_array($charges)) {
            foreach ($charges as $charge) {
                $this->charge[] = $charge;
            }
        } else {
            $this->charge[] = $charges;
        }
        return $this;
    }

    /**
     * @return array<int, LoadingUnit>
     */
    public function getCharge(): array
    {
        return $this->charge;
    }

    public function hasCharge(): bool
    {
        return count($this->charge) >= 1;
    }

    public function usedCapacity(): int|float
    {
        $usedCapacity = $this->realCapacityUsed();

        if ($usedCapacity > 1) {
            return 1;
        }

        return $usedCapacity;
    }

    public function usedCapacityFor(LoadingUnit $loadingUnit)
    {
        return max(
            $this->convertUsedCapacityToPercent($loadingUnit->getSize()->volume(), $this->capacity->maxVolumeAvailable),
            $this->convertUsedCapacityToPercent($loadingUnit->getWeight(), $this->capacity->maxWeightAuthorized)
        );
    }

    public function realCapacityUsed(): int|float
    {
        return max(
            $this->convertUsedCapacityToPercent($this->occupiedVolume(), $this->capacity->maxVolumeAvailable),
            $this->convertUsedCapacityToPercent($this->currentLoadedWeight(), $this->capacity->maxWeightAuthorized)
        );
    }

    protected function convertUsedCapacityToPercent(int|float $currentUsage, int|float $maxUsage): int|float
    {
        return $currentUsage / $maxUsage;
    }

    protected function occupiedVolume(): float|int
    {
        return array_reduce(
            $this->charge,
            fn (float|null $carry, LoadingUnit $item) => $carry + $item->getSize()->volume()
        ) ?? 0;
    }

    protected function currentLoadedWeight(): int|float
    {
        return array_reduce(
            $this->charge,
            fn (float|null $carry, LoadingUnit $item) => $carry + $item->getWeight()
        ) ?? 0;
    }

    public function emission(): Emission
    {
        return new Emission(
            $this->getCombustible(),
            $this->consumptionAvgInLiterFor100Km / 100,
            $this->getCountry()
        );
    }

    /**
     * @param Combustible $combustible
     * @param integer $consumptionAvgInLiterFor100Km
     * @param Capacity $capacity
     * @param Country $location
     * @param array<int, LoadingUnit> $charge
     */
    public static function make(
        Combustible $combustible,
        int|float $consumptionAvgInLiterFor100Km = 0,
        Capacity $capacity = new Capacity(1, 1),
        Country $location = Country::FRANCE,
        array $charge = []
    ): self {
        return new self($combustible, $consumptionAvgInLiterFor100Km, $capacity, $location, $charge);
    }
}
