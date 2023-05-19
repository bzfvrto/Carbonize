<?php

namespace Bzfvrto\Carbonize\Support;

abstract class CSVReader implements Reader
{
    public static string $source;

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

    public function resolveFormatter(): Formater
    {
        return match($this::$source) {
            'Ademe' => new CSVAdemeFormater(),
            default => new CSVAdemeFormater(),
        };
    }
}
