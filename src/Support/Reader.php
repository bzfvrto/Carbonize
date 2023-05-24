<?php

namespace Bzfvrto\Carbonize\Support;

use Bzfvrto\Carbonize\DTO\GasEmited;

interface Reader
{

    /**
     * @return array<int, array<int, string>>
     */
    public function read(): array;

    /**
     * @param string $attributFr
     * @return GasEmited
     */
    public function find(string $attributFr): GasEmited;

    public function formatter(): Formatter;
}
