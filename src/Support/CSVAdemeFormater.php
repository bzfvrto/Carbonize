<?php

namespace Bzfvrto\Carbonize\Support;

use Bzfvrto\Carbonize\DTO\GasEmited;

final class CSVAdemeFormater implements Formater
{
    /**
     * @param array<string, string> $csvArray
     * @return GasEmited
     */
    public function toDTO(array $csvArray): GasEmited
    {
        return new GasEmited(
            co2equivalent: (float) $csvArray['Total poste non décomposé'],
            co2f: (float) array_values($csvArray)[0],
            ch4f: (float) $csvArray['CH4f'],
            ch4b: (float) $csvArray['CH4b'],
            n2o: (float) $csvArray['N2O'],
            co2b: (float) $csvArray['CO2b'],
            otherGreenhouseGas: (float) $csvArray['Autres GES'],
            type: $csvArray['Type poste'] !== '' ? $csvArray['Type poste'] : 'total',
            baseName: $csvArray['Nom base français'],
            attributName: $csvArray['Nom attribut français'],
            unitFr: $csvArray['Unité français'],
            unitEn: $csvArray['Unité anglais'],
            contributor: $csvArray['Contributeur'],
            localisation: $csvArray['Localisation géographique'],
            validUntil: $csvArray['Période de validité']
        );
    }

    /**
     * @param array<int, array<int, string>> $csv
     * @return array<int, array<string, string>>
     */
    public function formatToArray(array $csv): array
    {
        $headers = $csv[0];
        unset($csv[0]);
        // Remove double ""
        $headers[0] = str_replace('"', '', $headers[0]);
        $formatedArray = [];

        foreach ($csv as $csvLine) {
            if(is_array($csvLine)) {
                $formatedArray[] = array_combine($headers, $csvLine);
            }
        }

        return $formatedArray;
    }
}
