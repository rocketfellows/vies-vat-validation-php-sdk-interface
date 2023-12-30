# VIES VAT number validation php sdk interface

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
![PHPStan Badge](https://img.shields.io/badge/PHPStan-level%205-brightgreen.svg?style=flat)
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

### Interface contract.
<hr>

- `VatNumberValidationServiceInterface` - sdk interface, return value type `VatNumberValidationResult`, input argument `VatNumber`;

- `VatNumber` - validated VAT;

- `VatNumberValidationResult` - validation result;

### Interface exceptions.
<hr>

`InvalidInputServiceException` - exception for api error code `INVALID_INPUT`.<br>
Description: ``the provided CountryCode is invalid or the VAT number is empty``.

`ServiceUnavailableException` - exception for api error code `SERVICE_UNAVAILABLE`.<br>
Description: `an error was encountered either at the network level or the Web application level, try again later`.

`MSUnavailableServiceException` - exception for api error code `MS_UNAVAILABLE`.<br>
Description: `the application at the Member State is not replying or not available. Please refer to the Technical Information page to check the status of the requested Member State, try again later`.

`TimeoutServiceException` - exception for api error code `TIMEOUT`.<br>
Description: `the application did not receive a reply within the allocated time period, try again later`.

`InvalidRequesterInfoServiceException` - exception for api error code `INVALID_REQUESTER_INFO`.

`VatBlockedServiceException` - exception for api error code `VAT_BLOCKED`.

`IPBlockedServiceException` - exception for api error code `IP_BLOCKED`.

`GlobalMaxConcurrentReqServiceException` - exception for api error code `GLOBAL_MAX_CONCURRENT_REQ`.<br>
Description: `your Request for VAT validation has not been processed; the maximum number of concurrent requests has been reached. Please re-submit your request later or contact TAXUD-VIESWEB@ec.europa.eu for further information": Your request cannot be processed due to high traffic on the web application. Please try again later`.

`GlobalMaxConcurrentReqTimeServiceException` - exception for api error code `GLOBAL_MAX_CONCURRENT_REQ_TIME`.

`MSMaxConcurrentReqServiceException` - exception for api error code `MS_MAX_CONCURRENT_REQ`.<br>
Description: `your Request for VAT validation has not been processed; the maximum number of concurrent requests for this Member State has been reached. Please re-submit your request later or contact TAXUD-VIESWEB@ec.europa.eu for further information": Your request cannot be processed due to high traffic towards the Member State you are trying to reach. Please try again later`.

`MSMaxConcurrentReqTimeServiceException` - exception for api error code `MS_MAX_CONCURRENT_REQ_TIME`.

`UnknownServiceErrorException` - exception thrown if it was not possible to understand what error code service returned.

`ServiceRequestException` - exception thrown if it was not possible to send a request to service (other errors).

`CountryCodeAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` country code attribute not found.

`RequestDateAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` request date attribute not found.

`ValidationFlagAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` validation flag attribute not found.

`VatNumberAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` vat number attribute not found.

`VatOwnerAddressAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` vat owner address attribute not found.

`VatOwnerNameAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` vat owner name attribute not found.

### Input arguments and return value.
<hr>

`VatNumber` type description (validated VAT):
- `countryCode` - _string_ - two-character country code, according to ISO 3166-1 standard;
- `vatNumber` - _string_ - validated VAT number.

`VatNumberValidationResult` type description (validation result):
- `vatNumber` - _VatNumber_ - validated VAT number;
- `requestDate` - _string_ - request date;
- `isValid` - _bool_ - validity flag;
- `name` - _null_ | _string_ - name;
- `address` - _null_ | _string_ - address.

## Interface implementations.

Implementations of this interface are provided in the [rocketfellows](https://github.com/orgs/rocketfellows/repositories) repositories (either already or in the future).

So far, VIES provides two services for validating the VAT number:
- Interactive web interface;
- SOAP web services API;
- REST web services API.

## Vat number validation result factory.

`rocketfellows\ViesVatValidationInterface\VatNumberValidationResultFactory` - a factory designed to create an instance of `rocketfellows\ViesVatValidationInterface\VatNumberValidationResult` from given raw data with required attributes existence check.

Factory functions:
- `public function createFromObject(stdClass $rawData): VatNumberValidationResult` - creates `VatNumberValidationResult` from `stdClass` object raw data;
- `public function createFromArray(array $rawData): VatNumberValidationResult` - creates `VatNumberValidationResult` from array raw data.

Functions throw next exceptions:
- `CountryCodeAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` country code attribute not found.

- `RequestDateAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` request date attribute not found.

- `ValidationFlagAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` validation flag attribute not found.

- `VatNumberAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` vat number attribute not found.

- `VatOwnerAddressAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` vat owner address attribute not found.

- `VatOwnerNameAttributeNotFoundException` - exception thrown if while creating instance of `VatNumberValidationResult` vat owner name attribute not found.

### Usage examples.

Creating `VatNumberValidationResult` from `stdClass` object raw data, where attribute names in raw data in camel case:

```php
$factory = new VatNumberValidationResultFactory();

$vatNumberValidationResult = $factory->createFromObject(
    (object) [
        'countryCode' => 'DE',
        'vatNumber' => '12312312',
        'requestDate' => '2023-12-12 20:20:20',
        'valid' => true,
        'name' => 'fooBar',
        'address' => 'barFoo',
    ]
);

var_dump(sprintf('VAT country code: %s', $vatNumberValidationResult->getCountryCode()));
var_dump(sprintf('VAT number: %s', $vatNumberValidationResult->getVatNumber()));
var_dump(sprintf('Request date: %s', $vatNumberValidationResult->getRequestDateString()));
var_dump(sprintf('Is VAT valid: %s', $vatNumberValidationResult->isValid() ? 'true' : 'false'));
var_dump(sprintf('VAT holder name: %s', $vatNumberValidationResult->getName()));
var_dump(sprintf('VAT holder address: %s', $vatNumberValidationResult->getAddress()));
```
```php
VAT country code: DE
VAT number: 12312312
Request date: 2023-12-12 20:20:20
Is VAT valid: true
VAT holder name: fooBar
VAT holder address: barFoo
```

Creating `VatNumberValidationResult` from `stdClass` object raw data, where attribute names in raw data in snake case:

```php
$factory = new VatNumberValidationResultFactory();

$vatNumberValidationResult = $factory->createFromObject(
    (object) [
        'country_code' => 'DE',
        'vat_number' => '12312312',
        'request_date' => '2023-12-12 20:20:20',
        'valid' => true,
        'name' => 'fooBar',
        'address' => 'barFoo',
    ]
);

var_dump(sprintf('VAT country code: %s', $vatNumberValidationResult->getCountryCode()));
var_dump(sprintf('VAT number: %s', $vatNumberValidationResult->getVatNumber()));
var_dump(sprintf('Request date: %s', $vatNumberValidationResult->getRequestDateString()));
var_dump(sprintf('Is VAT valid: %s', $vatNumberValidationResult->isValid() ? 'true' : 'false'));
var_dump(sprintf('VAT holder name: %s', $vatNumberValidationResult->getName()));
var_dump(sprintf('VAT holder address: %s', $vatNumberValidationResult->getAddress()));
```
```php
VAT country code: DE
VAT number: 12312312
Request date: 2023-12-12 20:20:20
Is VAT valid: true
VAT holder name: fooBar
VAT holder address: barFoo
```

Creating `VatNumberValidationResult` from array raw data, where attribute names in raw data in camel case:

```php
$factory = new VatNumberValidationResultFactory();

$vatNumberValidationResult = $factory->createFromArray(
    [
        'countryCode' => 'DE',
        'vatNumber' => '12312312',
        'requestDate' => '2023-12-12 20:20:20',
        'valid' => true,
        'name' => 'fooBar',
        'address' => 'barFoo',
    ]
);

var_dump(sprintf('VAT country code: %s', $vatNumberValidationResult->getCountryCode()));
var_dump(sprintf('VAT number: %s', $vatNumberValidationResult->getVatNumber()));
var_dump(sprintf('Request date: %s', $vatNumberValidationResult->getRequestDateString()));
var_dump(sprintf('Is VAT valid: %s', $vatNumberValidationResult->isValid() ? 'true' : 'false'));
var_dump(sprintf('VAT holder name: %s', $vatNumberValidationResult->getName()));
var_dump(sprintf('VAT holder address: %s', $vatNumberValidationResult->getAddress()));
```
```php
VAT country code: DE
VAT number: 12312312
Request date: 2023-12-12 20:20:20
Is VAT valid: true
VAT holder name: fooBar
VAT holder address: barFoo
```

Creating `VatNumberValidationResult` from array raw data, where attribute names in raw data in snake case:

```php
$factory = new VatNumberValidationResultFactory();

$vatNumberValidationResult = $factory->createFromArray(
    [
        'country_code' => 'DE',
        'vat_number' => '12312312',
        'request_date' => '2023-12-12 20:20:20',
        'valid' => true,
        'name' => 'fooBar',
        'address' => 'barFoo',
    ]
);

var_dump(sprintf('VAT country code: %s', $vatNumberValidationResult->getCountryCode()));
var_dump(sprintf('VAT number: %s', $vatNumberValidationResult->getVatNumber()));
var_dump(sprintf('Request date: %s', $vatNumberValidationResult->getRequestDateString()));
var_dump(sprintf('Is VAT valid: %s', $vatNumberValidationResult->isValid() ? 'true' : 'false'));
var_dump(sprintf('VAT holder name: %s', $vatNumberValidationResult->getName()));
var_dump(sprintf('VAT holder address: %s', $vatNumberValidationResult->getAddress()));
```
```php
VAT country code: DE
VAT number: 12312312
Request date: 2023-12-12 20:20:20
Is VAT valid: true
VAT holder name: fooBar
VAT holder address: barFoo
```

## Fault code exception factory.

`rocketfellows\ViesVatValidationInterface\FaultCodeExceptionFactory` - a factory designed to create exceptions based on an error code that the VAT number validation service can return.
Error code detection is case insensitive.

Input arguments:
- `$faultCode` - error code that the VAT number validation service can return;
- `$message` - optional - error message that the VAT number validation service can return.

**Creating exceptions, based on error code mapping:**

`InvalidInputServiceException` - exception for api error code `INVALID_INPUT`.<br>
Description: ``the provided CountryCode is invalid or the VAT number is empty``.

`ServiceUnavailableException` - exception for api error code `SERVICE_UNAVAILABLE`.<br>
Description: `an error was encountered either at the network level or the Web application level, try again later`.

`MSUnavailableServiceException` - exception for api error code `MS_UNAVAILABLE`.<br>
Description: `the application at the Member State is not replying or not available. Please refer to the Technical Information page to check the status of the requested Member State, try again later`.

`TimeoutServiceException` - exception for api error code `TIMEOUT`.<br>
Description: `the application did not receive a reply within the allocated time period, try again later`.

`InvalidRequesterInfoServiceException` - exception for api error code `INVALID_REQUESTER_INFO`.

`VatBlockedServiceException` - exception for api error code `VAT_BLOCKED`.

`IPBlockedServiceException` - exception for api error code `IP_BLOCKED`.

`GlobalMaxConcurrentReqServiceException` - exception for api error code `GLOBAL_MAX_CONCURRENT_REQ`.<br>
Description: `your Request for VAT validation has not been processed; the maximum number of concurrent requests has been reached. Please re-submit your request later or contact TAXUD-VIESWEB@ec.europa.eu for further information": Your request cannot be processed due to high traffic on the web application. Please try again later`.

`GlobalMaxConcurrentReqTimeServiceException` - exception for api error code `GLOBAL_MAX_CONCURRENT_REQ_TIME`.

`MSMaxConcurrentReqServiceException` - exception for api error code `MS_MAX_CONCURRENT_REQ`.<br>
Description: `your Request for VAT validation has not been processed; the maximum number of concurrent requests for this Member State has been reached. Please re-submit your request later or contact TAXUD-VIESWEB@ec.europa.eu for further information": Your request cannot be processed due to high traffic towards the Member State you are trying to reach. Please try again later`.

`MSMaxConcurrentReqTimeServiceException` - exception for api error code `MS_MAX_CONCURRENT_REQ_TIME`.

`UnknownServiceErrorException` - exception thrown if it was not possible to understand what error code service returned.

### Usage examples

Error code in upper case:

```php
$factory = new FaultCodeExceptionFactory();

$exception = $factory->create('INVALID_REQUESTER_INFO');

var_dump(get_class($exception));
```
```php
rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException
```

Error code in lower upper case:

```php
$factory = new FaultCodeExceptionFactory();

$exception = $factory->create('invalid_requester_info');

var_dump(get_class($exception));
```
```php
rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException
```

## Contributing.

Welcome to pull requests. If there is a major changes, first please open an issue for discussion.

Please make sure to update tests as appropriate.
