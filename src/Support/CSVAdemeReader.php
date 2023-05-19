<?php

namespace Bzfvrto\Carbonize\Support;

use Bzfvrto\Carbonize\DTO\GasEmited;

final class CSVAdemeReader extends CSVReader
{
    /**
     * @return array<int, array<string, string>>
     */
    private function csvArray(): array
    {
        $csvData = $this->read();

        return $this->formatter()->formatToArray($csvData);
    }

    /**
     * @param string $attributFr
     * @return GasEmited
     */
    public function find(string $attributFr): GasEmited
    {
        $searchFor = $attributFr;

        if ($attributFr === 'SUPER') {
            $searchFor = 'Supercarburant sans plomb (95, 95-E10, 98)';
        }

        return $this->formatter()->toDTO(array_values(
            array_filter($this->csvArray(), function($item) use ($searchFor) {
                return $item['Nom attribut français'] === $searchFor && $item['Type poste'] === '';
            })
        )[0]);
    }

    public function formatter(): Formater
    {
        return new CSVAdemeFormater();
    }
}
