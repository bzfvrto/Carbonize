<?php

namespace Bzfvrto\Carbonize\Support;

use Bzfvrto\Carbonize\DTO\GasEmited;

interface Formater
{
    /**
     * @param array<string, string> $csvArray
     * @return GasEmited
     */
    public function toDTO(array $csvArray): GasEmited;

    /**
     * @param array<int, array<int, string>> $csv
     * @return array<int, array<string, string>>
     */
    public function formatToArray(array $csv): array;
}
