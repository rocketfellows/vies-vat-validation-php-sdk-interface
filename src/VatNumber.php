<?php

namespace rocketfellows\ViesVatValidationInterface;

class VatNumber
{
    private $countryCode;
    private $vatNumber;

    public function __construct(string $countryCode, string $vatNumber)
    {
        $this->countryCode = $countryCode;
        $this->vatNumber = $vatNumber;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }
}
