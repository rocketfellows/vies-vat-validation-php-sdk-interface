# VIES VAT number validation php sdk interface

![Code Coverage Badge](./badge.svg)

The package provides VIES VAT number validation php sdk interface.

PHP sdk interface for VIES service for checking the validity of the VAT number.
Services that implement this interface are must be designed to send a request and process a response from the VAT validation service, depending on the API (REST/SOAP etc.).

Implementations of this interface are provided in the rocketfellows repositories (either already or in the future).

For more information about VIES VAT number validation services see https://ec.europa.eu/taxation_customs/vies/#/technical-information.

## Installation.

```shell
composer require rocketfellows/vies-vat-validation-php-sdk-interface
```

## Contributing.

Welcome to pull requests. If there is a major changes, first please open an issue for discussion.

Please make sure to update tests as appropriate.
