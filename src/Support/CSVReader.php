<?php

namespace Bzfvrto\Carbonize\Support;

final class CSVReader implements Reader
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

    /**
     * @return array<int, array<string, string>>
     */
    private function formatCSVDataToKeyedArray(): array
    {
        $csvData = $this->read();

        $headers = $csvData[0];
        unset($csvData[0]);
        // Remove double ""
        $headers[0] = str_replace('"', '', $headers[0]);

        $formatedArray = [];

        foreach ($csvData as $csvLine) {
            if(is_array($csvLine)) {
                $formatedArray[] = array_combine($headers, $csvLine);
            }
        }

        return $formatedArray;
    }

    /**
     * @param string $attributFr
     * @return array<int, array<string, string>>
     */
    public function find(string $attributFr): array
    {
        $searchFor = $attributFr;

        if ($attributFr === 'SUPER') {
            $searchFor = 'Supercarburant sans plomb (95, 95-E10, 98)';
        }

        return array_values(
            array_filter($this->formatCSVDataToKeyedArray(), function($item) use ($searchFor) {
                return $item['Nom attribut français'] === $searchFor && $item['Type poste'] === '';
            })
        );
    }
}