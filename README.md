# Carbonize carbon footprint made easy for transport.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bzfvrto/carbonize.svg)](https://packagist.org/packages/bzfvrto/carbonize)
[![Tests](https://github.com/bzfvrto/Carbonize/actions/workflows/tests.yml/badge.svg)](https://github.com/bzfvrto/Carbonize/actions/workflows/tests.yml)
[![Static Analysis](https://github.com/bzfvrto/Carbonize/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/bzfvrto/Carbonize/actions/workflows/static-analysis.yml)
![Code Climate maintainability](https://img.shields.io/codeclimate/maintainability/bzfvrto/Carbonize)
<!-- ![Code Climate technical debt](https://img.shields.io/codeclimate/tech-debt/bzfvrto/Carbonize) -->
<!-- ![Code Climate issues](https://img.shields.io/codeclimate/issues/bzfvrto/Carbonize) -->
<!-- ![GitHub top language](https://img.shields.io/github/languages/top/bzfvrto/Carbonize) -->
<!-- ![GitHub issues](https://img.shields.io/github/issues/bzfvrto/Carbonize) -->
<!-- ![GitHub](https://img.shields.io/github/license/bzfvrto/Carbonize)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/bzfvrto/Carbonize) -->
<!-- ![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/bzfvrto/carbonize/php) -->
<!-- [![Total Downloads](https://img.shields.io/packagist/dt/bzfvrto/carbonize.svg)](https://packagist.org/packages/bzfvrto/carbonize) -->

### Some words about me.

> *This is my first package.* <br />
I have made it, primarily to have feedback on my code.
I love to code since several years, but i have never publish open-source package. I'm not profesionnal developper but i'm looking for a school next year.

## Description

Carbonize aims to provide simple and clear API to build carbon footprint easily for private vehicles and delivery companies.
My goal is to make it compilent with the french law.

At this time, only base formula is implemented, it is the most generic and it does not allow fine calculation of emission.
<br />
Source of emission come from the [ADEME Base Empreinte](https://base-empreinte.ademe.fr).

> This package is a Work in progress. Breaking changes may occur.

I have take some help and inspiration from :
- [Geotools](https://github.com/thephpleague/geotools)
- [Spatie php skeleton](https://github.com/spatie/package-skeleton-php)
- [Nuno Maduro Skeleton-php](https://github.com/nunomaduro/skeleton-php)

## Installation

You can install the package via composer:

```bash
composer require bzfvrto/carbonize
```

## Usage

```php
$distance = new Distance(
        from: new Point(1, 2),
        to: new Point(4, 5)
    );

$distance
    ->setSteps([new Point(1,3), new Point(2, 4)])
    ->calculate();
    // output (float) distance in meters: 516972.895251

$vehicle = new Vehicle(
        combustible: Combustible::B7,
        consumptionAvgInLiterFor100Km: 7.5,
        location: Country::FRANCE
    );

$vehicle->emission()->getCO2EquivalentInGramsPerKm();
    // output (float) C02e in grammes per km: 232.5

(new Carbonize(
    vehicle: $vehicle,
    distance: $distance))->formatedResult();
    // output (string): 120196.198 gramme of CO2 emited for 516.97 km
```

## Roadmap
**What you can expect in the coming months:**

- [ ] **Formula 2**: Used when the vehicle carry many packages or people and it's fuel consumption is known for current transport service
- [ ] **Formula 3**: Used when the fuel consumption of the vehicle is unknown for current transport service and if there is only one package or people inside
- [ ] **Formula 4**: Used when vehicle carry many package or people and it's fuel consumption is unknown for current transport service
- [ ] Laravel package
- [ ] More country and Greenhouse gas provider
- [ ] More combustible type

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

<!-- ## Security Vulnerabilities

If you discover any security related issues, please email me instead of using the issue tracker. -->

## Credits

- [Basile Favretto](https://github.com/bzfvrto)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
