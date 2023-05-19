<?php

namespace Bzfvrto\Carbonize\Support;

abstract class CSVReader implements Reader
{
    public function __construct(
        private readonly string $url
    ) {
    }

    public function read(): array
    {
        $file = fopen($this->url, 'r');

        if (! $file) {
            throw new \Exception("Can not open files", 1);
        }

        $lines = [];
        while(!feof($file)) {
            $lines[] = fgetcsv($file);
        }

        fclose($file);

        return array_filter($lines);
    }
}
