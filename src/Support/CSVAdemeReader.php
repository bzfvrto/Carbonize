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
        $serachableTerm = $this->defineSearchableTerm($attributFr);

        return $this->formatter()->toDTO(array_values(
            array_filter($this->csvArray(), function($item) use ($serachableTerm) {
                return $item['Nom attribut français'] === $serachableTerm && $item['Type poste'] === '';
            })
        )[0]);
    }

    protected function defineSearchableTerm(string $term): string
    {
        if ($term === 'SUPER') {
            $term = 'Supercarburant sans plomb (95, 95-E10, 98)';
        }

        return $term;
    }

    public function formatter(): Formater
    {
        return new CSVAdemeFormater();
    }
}
