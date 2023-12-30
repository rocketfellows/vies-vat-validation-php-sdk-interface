<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\CountryCodeAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\RequestDateAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\ValidationFlagAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\VatNumberAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\VatOwnerAddressAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\VatOwnerNameAttributeNotFoundException;
use stdClass;

class VatNumberValidationResultFactory
{
    private const ATTRIBUTE_NAME_COUNTRY_CODE = 'countryCode';
    private const ATTRIBUTE_NAME_VAT_NUMBER = 'vatNumber';
    private const ATTRIBUTE_NAME_REQUEST_DATE = 'requestDate';
    private const ATTRIBUTE_NAME_VALIDATION_FLAG = 'valid';
    private const ATTRIBUTE_NAME_VAT_OWNER_NAME = 'name';
    private const ATTRIBUTE_NAME_VAT_OWNER_ADDRESS = 'address';

    /**
     * @throws CountryCodeAttributeNotFoundException
     * @throws RequestDateAttributeNotFoundException
     * @throws ValidationFlagAttributeNotFoundException
     * @throws VatNumberAttributeNotFoundException
     * @throws VatOwnerAddressAttributeNotFoundException
     * @throws VatOwnerNameAttributeNotFoundException
     */
    public function createFromObject(stdClass $rawData): VatNumberValidationResult
    {
        $countryCodeAttributeName = $this->getCasedExistedAttributeNameInObject(
            $rawData,
            self::ATTRIBUTE_NAME_COUNTRY_CODE
        );
        $vatNumberAttributeName = $this->getCasedExistedAttributeNameInObject(
            $rawData,
            self::ATTRIBUTE_NAME_VAT_NUMBER
        );
        $requestDateAttributeName = $this->getCasedExistedAttributeNameInObject(
            $rawData,
            self::ATTRIBUTE_NAME_REQUEST_DATE
        );
        $validationFlagAttributeName = $this->getCasedExistedAttributeNameInObject(
            $rawData,
            self::ATTRIBUTE_NAME_VALIDATION_FLAG
        );
        $varOwnerNameAttributeName = $this->getCasedExistedAttributeNameInObject(
            $rawData,
            self::ATTRIBUTE_NAME_VAT_OWNER_NAME
        );
        $varOwnerAddressAttributeName = $this->getCasedExistedAttributeNameInObject(
            $rawData,
            self::ATTRIBUTE_NAME_VAT_OWNER_ADDRESS
        );

        if (is_null($countryCodeAttributeName)) {
            throw new CountryCodeAttributeNotFoundException();
        }

        if (is_null($vatNumberAttributeName)) {
            throw new VatNumberAttributeNotFoundException();
        }

        if (is_null($requestDateAttributeName)) {
            throw new RequestDateAttributeNotFoundException();
        }

        if (is_null($validationFlagAttributeName)) {
            throw new ValidationFlagAttributeNotFoundException();
        }

        if (is_null($varOwnerNameAttributeName)) {
            throw new VatOwnerNameAttributeNotFoundException();
        }

        if (is_null($varOwnerAddressAttributeName)) {
            throw new VatOwnerAddressAttributeNotFoundException();
        }

        return VatNumberValidationResult::create(
            VatNumber::create(
                (string) $rawData->$countryCodeAttributeName,
                (string) $rawData->$vatNumberAttributeName
            ),
            (string) $rawData->$requestDateAttributeName,
            (bool) $rawData->$validationFlagAttributeName,
            (string) $rawData->$varOwnerNameAttributeName,
            (string) $rawData->$varOwnerAddressAttributeName
        );
    }

    public function createFromArray(array $rawData): VatNumberValidationResult
    {
        // TODO: implement
        return VatNumberValidationResult::create();
    }

    private function getCasedExistedAttributeNameInObject(stdClass $rawData, string $needleAttributeName): ?string
    {
        $foundAttributeName = null;

        if (property_exists($rawData, $needleAttributeName)) {
            $foundAttributeName = $needleAttributeName;
        }

        $needleCamelCasedAttributeName = $this->convertCamelCasedAttributeNameToSnake($needleAttributeName);
        if (property_exists($rawData, $needleCamelCasedAttributeName)) {
            $foundAttributeName = $needleCamelCasedAttributeName;
        }

        return $foundAttributeName;
    }

    private function convertCamelCasedAttributeNameToSnake(string $attrubuteName): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $attrubuteName));
    }
}
