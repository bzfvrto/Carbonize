# Carbonize carbon footprint made easy.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bzfvrto/carbonize.svg?style=flat-square)](https://packagist.org/packages/bzfvrto/carbonize)
<!-- [![Tests](https://img.shields.io/github/actions/workflow/status/bzfvrto/carbonize/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bzfvrto/carbonize/actions/workflows/run-tests.yml) -->
[![Total Downloads](https://img.shields.io/packagist/dt/bzfvrto/carbonize.svg?style=flat-square)](https://packagist.org/packages/bzfvrto/carbonize)

Carbonize aim to provide simple and clear API to build carbon footprint.

This is my first package.

I have drew inspiration from :

[![Geotools](https://github.com/thephpleague/geotools)](https://github.com/thephpleague/geotools)

[![Spatie php skeleton](https://github.com/spatie/package-skeleton-php/blob/main/README.md)](https://github.com/spatie/package-skeleton-php/blob/main/README.md)

## Installation

You can install the package via composer:

```bash
composer require bzfvrto/carbonize
```

## Usage

```php
$distance = Distance::make()
                ->setFrom(new Point(1, 2))
                ->setTo(new Point(4, 5))
                ->setSteps([new Point(1,3), new Point(2, 4)])
                ->calculate();
    // output (float) distance in meters: 516972.895251

$vehicle = Vehicle::make()
                ->setCombustible(Combustible::DIESEL)
                ->setConsumptionAvgFor100Km(7.5);

$vehicle->emission()->getCO2EquivalentInGrammePerKm();
    // output (float) C02e in grammes per km: 197.25

Carbonize::make()->setVehicle($vehicle)
                ->setDistance($distance)
                ->formatedResult();
    // output (string): 101972.904 gramme of CO2 emited for 516.97 km
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

<!-- Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details. -->

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Basile Favretto](https://github.com/bzfvrto)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
