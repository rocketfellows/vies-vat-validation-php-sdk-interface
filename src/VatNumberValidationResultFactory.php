<?php

namespace rocketfellows\ViesVatValidationInterface;

use stdClass;

class VatNumberValidationResultFactory
{
    private const ATTRIBUTE_NAME_COUNTRY_CODE = 'countryCode';
    private const ATTRIBUTE_NAME_VAT_NUMBER = 'vatNumber';
    private const ATTRIBUTE_NAME_REQUEST_DATE = 'requestDate';
    private const ATTRIBUTE_NAME_VALIDATION_FLAG = 'valid';
    private const ATTRIBUTE_NAME_VAT_OWNER_NAME = 'name';
    private const ATTRIBUTE_NAME_VAT_OWNER_ADDRESS = 'address';

    public function createFromObject(stdClass $rawData): VatNumberValidationResult
    {
        // TODO: implement
        return VatNumberValidationResult::create();
    }

    public function createFromArray(array $rawData): VatNumberValidationResult
    {
        // TODO: implement
        return VatNumberValidationResult::create();
    }

    private function convertCamelCasedAttributeNameToSnake(string $attrubuteName): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $attrubuteName));
    }
}
