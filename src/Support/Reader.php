<?php

namespace Bzfvrto\Carbonize\Support;

interface Reader
{

    /**
     * @return array<int, array<int, string>>
     */
    public function read(): array;

    /**
     * @param string $attributFr
     * @return array<int, array<string, string>>
     */
    public function find(string $attributFr): array;
}
