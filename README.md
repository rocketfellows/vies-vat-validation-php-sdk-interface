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

## Interface description.

Interface contract:

- `VatNumberValidationServiceInterface` - sdk interface;

- `VatNumber` - validated VAT;

- `VatNumberValidationResult` - validation result;

Interface exceptions:

- `InvalidInputServiceException` - exception for api error code `INVALID_INPUT`, which means: the provided `CountryCode` is invalid or the VAT number is empty;
- `ServiceUnavailableException` - exception for api error code `SERVICE_UNAVAILABLE`, which means: an error was encountered either at the network level or the Web application level, try again later;
- `MSUnavailableServiceException` - exception for api error code `MS_UNAVAILABLE`, which means: the application at the Member State is not replying or not available. Please refer to the Technical Information page to check the status of the requested Member State, try again later;
- `TimeoutServiceException` - exception for api error code `TIMEOUT`, which means: the application did not receive a reply within the allocated time period, try again later;
- `InvalidRequesterInfoServiceException` - exception for api error code `INVALID_REQUESTER_INFO`;
- `VatBlockedServiceException` - exception for api error code `VAT_BLOCKED`;
- `IPBlockedServiceException` - exception for api error code `IP_BLOCKED`;
- `GlobalMaxConcurrentReqServiceException` - exception for api error code `GLOBAL_MAX_CONCURRENT_REQ`, which means: your Request for VAT validation has not been processed; the maximum number of concurrent requests has been reached. Please re-submit your request later or contact TAXUD-VIESWEB@ec.europa.eu for further information": Your request cannot be processed due to high traffic on the web application. Please try again later;

## Contributing.

Welcome to pull requests. If there is a major changes, first please open an issue for discussion.

Please make sure to update tests as appropriate.
