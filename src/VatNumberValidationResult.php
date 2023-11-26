<?php

namespace rocketfellows\ViesVatValidationInterface;

class VatNumberValidationResult
{
    private $vatNumber;
    private $requestDate;
    private $isValid;
    private $name;
    private $address;

    public function __construct(
        VatNumber $vatNumber,
        string $requestDate,
        bool $isValid,
        ?string $name = null,
        ?string $address = null
    ) {
        $this->vatNumber = $vatNumber;
        $this->requestDate = $requestDate;
        $this->isValid = $isValid;
        $this->name = $name;
        $this->address = $address;
    }
}
