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
}
