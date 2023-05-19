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
            throw new \Exception("Can not open file", 1);
        }

        $csvArray = $this->buildArrayFromCSVLines($file);

        fclose($file);

        return $this->removeFalseValueFromArray($csvArray);
    }

    /**
     * @param resource $csvFile
     * @return array<int, false|array<int, string>>
     */
    protected function buildArrayFromCSVLines(mixed $csvFile): array
    {
        $lines = [];
        while(!feof($csvFile)) {
            $lines[] = fgetcsv($csvFile);
        }

        return $lines;
    }

    /**
     * @param array<int, false|array<int, string>> $csvArray
     * @return array<int, array<int, string>>
     */
    protected function removeFalseValueFromArray(array $csvArray): array
    {
        return array_filter($csvArray);
    }
}
