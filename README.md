# This is my package filament-dupr-social-login

[![Latest Version on Packagist](https://img.shields.io/packagist/v/infoesportes/filament-dupr-social-login.svg?style=flat-square)](https://packagist.org/packages/infoesportes/filament-dupr-social-login)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/Info-Esportes/filament-dupr-social-login/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/Info-Esportes/filament-dupr-social-login/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/Info-Esportes/filament-dupr-social-login/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/Info-Esportes/filament-dupr-social-login/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/infoesportes/filament-dupr-social-login.svg?style=flat-square)](https://packagist.org/packages/infoesportes/filament-dupr-social-login)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require infoesportes/filament-dupr-social-login
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-dupr-social-login-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-dupr-social-login-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-dupr-social-login-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentDuprSocialLogin = new InfoEsportes\FilamentDuprSocialLogin();
echo $filamentDuprSocialLogin->echoPhrase('Hello, InfoEsportes!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Luiz Cristino](https://github.com/Info-Esportes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
